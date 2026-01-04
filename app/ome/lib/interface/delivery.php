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

class ome_interface_delivery{

    /**
     * iscancel
     * @param mixed $delivery_bn delivery_bn
     * @return mixed 返回值
     */
    public function iscancel($delivery_bn){
        $dlyObj = app::get('ome')->model('delivery');
        $dlyInfo = $dlyObj->dump(array('delivery_bn'=>$delivery_bn),'status');
        if(in_array($dlyInfo['status'],array('failed','cancel','back','stop'))){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取OmeDlyShipType
     * @param mixed $delivery_bn delivery_bn
     * @return mixed 返回结果
     */
    public function getOmeDlyShipType($delivery_bn){
        $dlyObj = app::get('ome')->model('delivery');
        $dlyInfo = $dlyObj->dump(array('delivery_bn'=>$delivery_bn),'delivery');
        return isset($dlyInfo['delivery']) ? $dlyInfo['delivery'] : '';
    }
}