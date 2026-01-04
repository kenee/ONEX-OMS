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

class ome_shop_relation{

    /**
     * 店铺绑定
     */
    public function bind($shop_id){
        //同步店铺支付方式
        $payFuncObj = kernel::single("ome_payment_func");
        if(method_exists($payFuncObj, 'sync_payments')){
            $payFuncObj->sync_payments($shop_id);
        }
        if($shop_id){
            $mdl_ome_shop = app::get('ome')->model('shop');
            $rs_shop = $mdl_ome_shop->dump($shop_id);
            if($rs_shop["node_id"] && $rs_shop['node_type'] == 'taobao'){
                $sdf = array();
                //kernel::single('invoice_event_trigger_einvoice')->bindTbTmcGroup($shop_id,$sdf);
            }
        }
        return true;
    }

    /**
     * 解除店铺绑定
     */
    public function unbind($shop_id){
        //删除店铺支付方式
        $payFuncObj = kernel::single("ome_payment_func");
        if(method_exists($payFuncObj, 'del_payments')){
            $payFuncObj->del_payments($shop_id);
        }

        //删除库存同步日志
        $stockLogObj = app::get('ome')->model('api_stock_log');
        $stockLogObj->delete(array('shop_id'=>$shop_id));
        return true;
    }
}
