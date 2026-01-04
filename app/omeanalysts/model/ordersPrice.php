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

class omeanalysts_mdl_ordersPrice extends dbeav_model{

    function price_interval($data = null){
        $interval_price = app::get('omeanalysts')->model('interval');
        $interval_list = $interval_price->getList();
        $db = kernel::database();
        $order_price = array();
        
        $data['to'] = $data['to'] + 86400;

        foreach($interval_list as $v){

            if(empty($data['shop_id'])){
                $sql = "select sum(num) as num from sdb_omeanalysts_ordersPrice where interval_id = ".$v['interval_id']." AND dates >= ".$data['from']." AND dates <= ".$data['to']."";
                $info = $db->selectrow($sql);
                $order_price[] .= $info['num'];
            }else{
                $sql = "select sum(num) as num from sdb_omeanalysts_ordersPrice where interval_id = ".$v['interval_id']." AND dates >= ".$data['from']." AND dates <= ".$data['to']." AND shop_id = '".$data['shop_id']."'";
                $info = $db->selectrow($sql);
                $order_price[] .= $info['num'];
            }
        }

        return $order_price;

    }

    function del(){
        $sql = "truncate table sdb_omeanalysts_interval";
        kernel::database()->exec($sql);
    }
}
?>