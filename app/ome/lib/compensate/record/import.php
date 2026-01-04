<?php
/**
 * Copyright 2012-2026 ShopeX (https://www.shopex.cn)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class ome_compensate_record_import
{
    const IMPORT_TITLE = [
        '赔付单号' => 'compensate_bn',
        '赔付类型' => 'type',
        '订单号' => 'order_bn',
        '店铺编码' => 'shop_id',
        '赔付金额' => 'compensateamount',
        '赔付原因' => 'reason',
    ];

    /**
     * 获取ExcelTitle
     * @return mixed 返回结果
     */
    public function getExcelTitle()
    {
        return ['直赔单导入.xlsx', [array_keys(self::IMPORT_TITLE)]];
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function processExcelRow($import_file, $post)
    {
        // 读取文件
        return kernel::single('omecsv_phpoffice')->import($import_file, function ($line, $buffer, $post, $highestRow) {
            static $title;

            if ($line == 1) {
                $title = $buffer;

                // 验证模板是否正确
                if (array_filter($title) != array_keys(self::IMPORT_TITLE)) {

                    return [false, '导入模板不正确'];
                }

                return [true];
            }
            if(count($buffer) < count(self::IMPORT_TITLE)) {
                return [true, '导入列不够', 'warnning'];
            }
            $buffer = array_combine(array_values(self::IMPORT_TITLE), array_slice($buffer, 0, count(self::IMPORT_TITLE)));
            $require = ['compensate_bn', 'order_bn', 'shop_id'];
            foreach($require as $v) {
                if(empty($buffer[$v])) {
                    return [true, array_search($v, self::IMPORT_TITLE) . '不能为空', 'warnning'];
                }
            }
            $shop = app::get('ome')->model('shop')->db_dump(['shop_bn'=>$buffer['shop_id']], 'shop_id');
            if(empty($shop)) {
                return [true, $buffer['shop_id'].'店铺不存在', 'warning'];
            }
            $buffer['shop_id'] = $shop['shop_id'];
            $model = app::get('ome')->model('compensate_record');
            $row = $model->db_dump(['compensate_bn'=>$buffer['compensate_bn'], 'shop_id'=>$buffer['shop_id']], 'id');
            if($row['id']) {
                return [true, $buffer['compensate_bn'].'直赔单号已存在', 'warning'];
            }
            $buffer['shouldpay'] = $buffer['compensateamount'];
            $buffer['check_status'] = '1';
            $buffer['can_second_appeal'] = '1';
            $buffer['op_name'] = kernel::single('desktop_user')->get_login_name();
            $model->insert($buffer);
            kernel::single('ome_compensate_record')->insertAftersale($buffer['id']);
            return [true];
        }, []);
    }
}
