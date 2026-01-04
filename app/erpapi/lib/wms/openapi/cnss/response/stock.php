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


class erpapi_wms_openapi_cnss_response_stock extends erpapi_wms_response_stock
{
    /**
     * quantity
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function quantity($params){
        $items = isset($params['item']) ? json_decode($params['item'],true) : array();

        foreach ($items as $key => $value) {
            if ($value['product_bn']) {
                $bn = kernel::single('material_codebase')->getBnBybarcode($value['product_bn']);

                $items[$key]['product_bn'] = $bn;
            }
        }

        $params['item'] = json_encode($items);

        return parent::quantity($params);
    }
}
