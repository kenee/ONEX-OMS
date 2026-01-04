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
/**
 * @Author: xueding@shopex.cn
 * @Datetime: 2022/4/18
 * @Describe: 天猫优仓商品相关处理
 */
class erpapi_dchain_matrix_taobao_request_product extends erpapi_dchain_request_product
{
    /**
     * 创建更新重组参数
     * @param $params
     * @return mixed
     */

    public function _formatProductParams($params)
    {
        $data = array();
        foreach ($params['items'] as $key => $value) {
            $data[] = [
                'sc_item_name'          => $value['product_name'],
                'sc_item_code'          => $value['shop_product_bn'],
                'bar_code'              => $value['shop_barcode'],
                'industry'              => 'NORMAL',
                'need_notify_warehouse' => '0',
            ];
        }
        
        $param['sc_items'] = json_encode($data);
        return $param;
    }
    
    /**
     * 创建更新pkg重组参数
     * @param $params
     * @return mixed
     */
    public function _formatPkgParams($params)
    {
        $data = array();
        foreach ($params['items'] as $key => $value) {
            $data[] = [
                'combine_sc_item_name' => $value['product_name'],
                'combine_sc_item_code' => $value['shop_product_bn'],
                'sub_sc_items'         => $params['pkg_items_list'][$value['product_id']],
            ];
        }

        $param['combine_sc_items'] = json_encode($data);
        return $param;
    }
    /**
     * 创建更新商货品重组参数
     * @param $params
     * @return mixed
     */
    public function _formatItemMappingParams($params)
    {
        $data = array();
        foreach ($params['items'] as $key => $value) {
            $data[] = $value;
        }

        $param['item_mappings'] = json_encode($data);
        return $param;
    }
    
}