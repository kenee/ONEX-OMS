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
* 延保服务插件
*
* @author sunjing<sunjing@shopex.cn>
* @version $Id: promotion.php 2013-3-12 17:23Z
*/
class erpapi_shop_response_plugins_order_service extends erpapi_shop_response_plugins_order_abstract
{
    /**
     * convert
     * @param erpapi_shop_response_abstract $platform platform
     * @return mixed 返回值
     */

    public function convert(erpapi_shop_response_abstract $platform)
    {
        $servicesdf = array();

        if ($platform->_ordersdf['service_order_objects']['service_order']) {
            foreach ((array) $platform->_ordersdf['service_order_objects']['service_order'] as $key => $value) {


                $servicesdf[] = array(
                    'order_id'      =>  $platform->_tgOrder['order_id'],
                    'item_oid'      =>  $value['item_oid'] ,
                    'refund_id'     =>  $value['refund_id'],
                    'sale_price'    =>  $value['sale_price'],
                    'oid'           =>  $value['oid'],
                    'tmser_spu_code'=>  $value['tmser_spu_code'],
                    'num'           =>  $value['num'],
                    'total_fee'     =>  $value['total_fee'],
                    'type_alias'    =>  $value['type_alias'],
                    'title'         =>  $value['title'],
                    'service_id'    =>  $value['service_id'],
                    'type'          =>  $value['type'],
                );
            }
        }



        return $servicesdf;
    }

    /**
     * 订单完成后处理
     *
     * @return void
     * @author 
     **/
    public function postCreate($order_id,$servicesdf)
    {

        $serviceObj = app::get('ome')->model('order_service');
        $service_price = 0;
        foreach ($servicesdf as $key=>$value){
            $service_price+=$value['total_fee'];
            $servicesdf[$key]['order_id'] = $order_id;
        }
        $sql = ome_func::get_insert_sql($serviceObj,$servicesdf);

        kernel::database()->exec($sql);

        if($service_price>0){
            kernel::database()->exec("UPDATE sdb_ome_orders SET service_price=".$service_price." WHERE order_id=".$order_id);
        }
    }


}