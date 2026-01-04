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
 * 订单接口处理
 *
 * @category
 * @package
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_shop_matrix_360buy_response_jdlvmi_order extends erpapi_shop_matrix_360buy_response_order
{
    protected function _analysis()
    {
        parent::_analysis();
        $this->_ordersdf['ship_status'] = intval($this->_ordersdf['ship_status']);

        $extend_field = $this->_ordersdf['extend_field'];

        $store_code = $extend_field['warehouseNo'];
        foreach ($this->_ordersdf['order_objects'] as &$object) {
            $object['store_code'] = $store_code;

            $object['shop_goods_id'] = $object['shop_goods_id'] ? $object['shop_goods_id'] : $object['bn'];
            foreach ($object['order_items'] as &$item) {
                $item['shop_goods_id'] = $item['shop_goods_id'] ? $item['shop_goods_id'] : $item['bn'];
                //货号不存在
                $bn = $item['bn'];

                $sku = $this->get_sku($bn);
                if($sku){
                    $object['bn'] = $item['bn'] = $sku['shop_product_bn'];
  
                }else{
                    $item['bn'] = '';
                }
                     
            }
        }


        $this->_ordersdf['shipping']['shipping_id'] = $extend_field['expressCode'];

        $this->_ordersdf['shipping']['shipping_name'] = $extend_field['logisticsCode'];

        $this->_ordersdf['order_bool_type'] = intval($this->_ordersdf['order_bool_type']) |  ome_order_bool_type::__JDLVMI_CODE;

        if($extend_field['deliveryOrderCode']){
            $this->_ordersdf['platform_order_bn'] = $extend_field['deliveryOrderCode'];
        }
        //地区信息
        list(, $mainland)             = explode(':', $this->__channelObj->channel['area']);
        list($province, $city, $area) = explode('/', $mainland);


        $this->_ordersdf['consignee']['area_state'] = $this->_ordersdf['consignee']['area_state'] ? $this->_ordersdf['consignee']['area_state'] : $province;

        $this->_ordersdf['consignee']['area_city'] = $this->_ordersdf['consignee']['area_city'] ? $this->_ordersdf['consignee']['area_city'] : $city;
        $this->_ordersdf['consignee']['area_district'] = $this->_ordersdf['consignee']['area_district'] ? $this->_ordersdf['consignee']['area_district'] : $area;

        
        $this->_ordersdf['consignee']['name'] = $this->_ordersdf['consignee']['name'] ? $this->_ordersdf['consignee']['name'] : '无需收货人';

        $this->_ordersdf['consignee']['name'] = $this->_ordersdf['consignee']['name'] ? $this->_ordersdf['consignee']['name'] : '无需收货人';
       
        $addr = $this->__channelObj->channel['addr'];
        $mobile = $this->__channelObj->channel['mobile'];
        $this->_ordersdf['consignee']['addr'] = $this->_ordersdf['consignee']['addr'] ? $this->_ordersdf['consignee']['addr'] : $addr;

        $this->_ordersdf['consignee']['mobile'] = $this->_ordersdf['consignee']['mobile'] ? $this->_ordersdf['consignee']['mobile'] : $mobile;
    }



    /**
     * 获取_sku
     * @param mixed $bn bn
     * @return mixed 返回结果
     */

    public function get_sku($bn){

        $shop_id = $this->__channelObj->channel['shop_id'];

        $skuMdl = app::get('inventorydepth')->model('shop_skus');
        $skus = $skuMdl->db_dump(array('shop_id'=>$shop_id,'shop_sku_id'=>$bn),'shop_product_bn');

        if($skus){
            return $skus;
        }else{
            return array();
        }

    }
    /**
     * 获取货品
     *
     * @param String $num_iid 商品ID
     * @return void
     * @author 
     **/
    protected function item_get($num_iid)
    {
        static $goods;

        if ($goods[$num_iid]) return $goods[$num_iid];

        $rs = kernel::single('erpapi_router_request')->set('shop',$this->__channelObj->channel['shop_id'])->product_item_get($num_iid);

        if ($rs['rsp'] == 'fail' || !$rs['data'] ){
            return array();
        }
        
        return $goods[$num_iid];
    }


    protected function _createAnalysis(){
        

    }

    protected function _canAccept()
    {
        foreach($this->_ordersdf['order_objects'] as $object){
            foreach ($object['order_items'] as $item) {
                if(empty($item['bn'])){
                    $this->__apilog['result']['msg'] = '货号不存在不接收';
                    return false;
                }
            }
        }

        return parent::_canAccept();
    }

    protected function get_create_plugins()
    {
        $plugins = parent::get_create_plugins();

        $plugins[] = 'orderextend';

        return $plugins;
    }
}
