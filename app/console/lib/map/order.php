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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0 
 * @DateTime: 2020/12/14 17:11:21
 * @describe: 订单获取坐标
 * ============================
 */
class console_map_order extends console_map_abstract {

    protected function _getAddress($id) {
        $mdl = app::get('ome')->model('orders');
        $order = $mdl->db_dump(array('order_id'=>$id), 'ship_area,ship_addr');
        $area = explode(':', $order['ship_area']);
        $area = explode('/', $area[1]);
        if(empty($area)) {
            return array();
        }
        $orderExtend = app::get('ome')->model('order_extend')->db_dump(array('order_id'=>$id), 'location');
        $sdf = array(
            'id' => $id,
            'city' => $area[1],
            'address' => $area[0] . $area[1] . $area[2] . $order['ship_addr'],
            'location' => $orderExtend['location']
        );
        return $sdf;
    }

    protected function _dealResult($data, $sdf){
        if($data['rsp'] == 'succ') {
            $upData = array(
                'order_id' => $sdf['id'],
                'location' => $data['location']
            );
            app::get('ome')->model('order_extend')->db_save($upData);
        }
    }
}