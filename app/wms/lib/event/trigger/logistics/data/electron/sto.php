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

class wms_event_trigger_logistics_data_electron_sto extends wms_event_trigger_logistics_data_electron_common {
    protected $needGetWBExtend = true;

    protected function getWaybillExtendSdf($arrDelivery, $shop){
        
        $basicMaterialObj    = app::get('material')->model('basic_material');
        
        $sdf = array();
        foreach($arrDelivery as $delivery) {
            $deliveryItems = $this->getDeliveryItems($delivery['delivery_id']);
            
            $product_name = '';
            foreach ($deliveryItems as $item) {
                
                $basicMateriaItem    = $basicMaterialObj->dump(array('material_bn'=>$item['bn']), 'bm_id, material_name');
                
                $product_name        = $basicMateriaItem['material_name'];
                break;
            }
            $sdf[] = array(
                'delivery' => $delivery,
                'shop' => $shop,
                'product_name' => $product_name
            );
        }
        return $sdf;
    }

    /**
     * 获取DirectSdf
     * @param mixed $arrDelivery arrDelivery
     * @param mixed $arrBill arrBill
     * @param mixed $shop shop
     * @return mixed 返回结果
     */
    public function getDirectSdf($arrDelivery, $arrBill, $shop) {
        return false;
    }
}