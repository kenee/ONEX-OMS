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
 * 发货单处理
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_shopex_publicb2c_request_delivery extends erpapi_shop_matrix_shopex_request_delivery
{
    /**
     * 添加发货单参数
     *
     * @return void
     * @author 
     **/

    protected function get_add_params($sdf)
    {
        $param = parent::get_add_params($sdf);

        // 发货地址
        $consignee_area = $sdf['consignee']['area'];
        kernel::single('ome_func')->split_area($consignee_area);
        $receiver_state    = ome_func::strip_bom(trim($consignee_area[0]));
        $receiver_city     = ome_func::strip_bom(trim($consignee_area[1]));
        $receiver_district = ome_func::strip_bom(trim($consignee_area[2]));

        $param['receiver_state']    = $receiver_state;
        $param['receiver_city']     = $receiver_city;
        $param['receiver_district'] = $receiver_district;
        
        return $param;
    }

    protected function get_confirm_params($sdf)
    {
        $param = array(
            'tid'                   => $sdf['orderinfo']['order_bn'],
            'shipping_id'           => $sdf['delivery_bn'],
            'status'                => self::$ship_status[$sdf['status']],
            'logistics_no'          =>  $sdf['logi_no']? $sdf['logi_no']   : '',
            'logistics_company'     =>  $sdf['logi_name'] ? $sdf['logi_name'] : '',
            'logistics_code'        =>  $sdf['logi_type'] ? $sdf['logi_type'] : '',
        );

        return $param;
    }
}