<?php
/**
 * Copyright 2026 ShopeX (https://www.shopex.cn)
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

class erpapi_logistics_matrix_dewu_request_template extends erpapi_logistics_request_template
{
    /**
     * syncStandardTpl
     * @return mixed 返回值
     */
    public function syncStandardTpl()
    {
        return ['rsp' => 'succ'];
    }

    /**
     * syncUserTpl
     * @return mixed 返回值
     */
    public function syncUserTpl()
    {
        // 品牌直发不允许自己绘制面单，为了兼容oms系统，返回一条默认数据
        $rs = [
            'rsp'  => 'succ',
            'data' => [[
                'out_template_id' => '0',
                'tpl_index'       => 'DEWU',
                'template_name'   => '得物默认模板',
                'template_type'   => 'dewu_ppzf',
                'status'          => 'true',
                'template_width'  => '70',
                'template_height' => '170',
                'file_id'         => '0',
                'is_logo'         => 'true',
                'template_data'   => '',
                'is_default'      => 'true',
                'page_type'       => '1',
                'aloneBtn'        => false,
                'btnName'         => '',
                'source'          => 'dewu',
                'cp_code'         => '',
            ],
            [
                'out_template_id' => '0',
                'tpl_index'       => 'DEWU-ZY',
                'template_name'   => '得物自研控件默认模板',
                'template_type'   => 'dewu_ppzf_zy',
                'status'          => 'true',
                'template_width'  => '70',
                'template_height' => '170',
                'file_id'         => '0',
                'is_logo'         => 'true',
                'template_data'   => '',
                'is_default'      => 'true',
                'page_type'       => '1',
                'aloneBtn'        => false,
                'btnName'         => '',
                'source'          => 'dewu',
                'cp_code'         => '',
            ]],
        ];
        return $rs;
    }

    /**
     * 获取UserDefinedTpl
     * @param mixed $params 参数
     * @return mixed 返回结果
     */
    public function getUserDefinedTpl($params)
    {
        return ['rsp' => 'succ'];
    }
}
