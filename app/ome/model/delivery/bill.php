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

class ome_mdl_delivery_bill extends dbeav_model{
    
    /**
     * 是否支持导出字段定义
     */
    var $has_export_cnf = true;
    
    /**
     * 导出的文件名
     */
    var $export_name = '包裹中心数据';
    
    /**
     * 导出明细
     *
     * @param array $list
     * @param array $colArray
     * @return array
     **/
    public function getExportDetailV2($list, $colArray)
    {
        $delivery_ids = array_unique(array_column($list, 'delivery_id'));
        if (!$delivery_ids) {
            return [$list, $colArray];
        }

        // 添加包裹明细字段
        $colArray['p_item_bn']             = ['label' => '基础物料号'];
        $colArray['p_item_number']         = ['label' => '数量'];

        $list = array_column($list, null, 'delivery_id');

        $mdl = app::get('ome')->model('delivery_package');
    
        // 先用delivery_id查询所有明细
        $allPackages = $mdl->getList('*', array('delivery_id|in' => $delivery_ids));
        
        // 按delivery_id和logi_no分组
        $packagesByDeliveryId = [];
        foreach ($allPackages as $package) {
            $packagesByDeliveryId[$package['delivery_id']][$package['logi_no']][] = $package;
        }
        
        $listV2 = [];
        foreach ($list as $delivery_bill) {
            $delivery_id = $delivery_bill['delivery_id'];
            $logi_no = $delivery_bill['logi_no'];
            
            // 根据delivery_id和logi_no直接匹配明细
            if (isset($packagesByDeliveryId[$delivery_id][$logi_no])) {
                foreach ($packagesByDeliveryId[$delivery_id][$logi_no] as $package) {
                    $l = array_merge((array)$delivery_bill, [
                        'p_item_bn'             => $package['bn'],
                        'p_item_number'         => $package['number'],
                    ]);
                    $listV2[] = $l;
                }
            }
        }

        return [$listV2, $colArray];
    }
}
?>