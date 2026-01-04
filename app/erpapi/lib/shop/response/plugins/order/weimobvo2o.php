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
*
* @author sunjing<sunjing@shopex.cn>
* @version $Id: 2020-2-4
*/
class erpapi_shop_response_plugins_order_weimobvo2o extends erpapi_shop_response_plugins_order_abstract
{

    /**
     * convert
     * @param erpapi_shop_response_abstract $platform platform
     * @return mixed 返回值
     */

    public function convert(erpapi_shop_response_abstract $platform)
    {
        $o2oData = array();


        if ($platform->_ordersdf['o2o_info']){
            $o2o_info = $platform->_ordersdf['o2o_info'];
            if ($o2o_info){
                $o2oData=array(
                    'store_code'    =>  $o2o_info['store_code'],
                    'store_name'    =>  $o2o_info['store_name'],
                );
            }
        }

       
        return $o2oData;
    }

    /**
     *
     * @return 
     * @author
     **/
    public function postCreate($order_id,$o2oData)
    {
        $orderObj = app::get('ome')->model('orders');
        
        if ($o2oData){
           
            $extendObj = app::get('ome')->model('order_extend');
            $extend_data =array(
                'o2o_store_bn'  =>  $o2oData['store_code'],
                'o2o_store_name'=>  $o2oData['store_name'],
                'order_id'      =>  $order_id,
            );

            $extendObj->save($extend_data);

            
        }
        


    }

    
}
