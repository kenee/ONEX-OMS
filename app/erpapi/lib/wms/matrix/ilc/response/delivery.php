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
/**
 * WMS 发货单
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_matrix_ilc_response_delivery  extends erpapi_wms_response_delivery 
{
    /**
     * status_update
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function status_update($params){
        $params = parent::status_update($params);

        if ($params['items']){
            foreach ((array) $params['items'] as $key=>$item){
                $barcode = $item['bn'] ? $item['bn'] : $item['product_bn'];

                // 条码转货号
                if ($barcode) {
                    $bn = kernel::single('material_codebase')->getBnBybarcode($barcode);
                    $params['items'][$key]['bn'] = $params['items'][$key]['product_bn'] = $bn ? $bn : $barcode;    
                }
            }
        }

        return $params;
    }
}
