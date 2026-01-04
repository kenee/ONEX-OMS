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

//已弃用 全渠道无需iframe绑定奇门
class tbo2o_rpc_response_channel extends ome_rpc_response{
    /**
     * qimen_callback
     * @param mixed $result result
     * @return mixed 返回值
     */
    public function qimen_callback($result){
        $nodes = $_POST;
        $status = $nodes['status'];
        $node_id = $nodes['node_id'];
        $node_type = $nodes['node_type'];
        if($node_type != "qimen"){
            //非淘宝全渠道奇门绑定
            die(1);
        }
        $mdlTbo2oShop = app::get('tbo2o')->model('shop');
        
        $tbo2o_shop = kernel::single('tbo2o_common')->getTbo2oShopInfo();
        
        if(!empty($tbo2o_shop)){
            $filter_arr = array("id"=>$tbo2o_shop["id"]);
        }
        if ($status == 'bind'){
            //绑定
            $sql_arr = array("qimen_node_id" => $node_id);
            if($filter_arr){
                //有配置信息 更新记录
                $mdlTbo2oShop->update($sql_arr,$filter_arr);
            }else{
                //无配置信息  新建记录
                $mdlTbo2oShop->insert($sql_arr);
            }
        }elseif ($status == 'unbind' && $tbo2o_shop["qimen_node_id"] == $node_id){
            //解绑
            $sql_arr = array("qimen_node_id" => "");
            if($filter_arr){
                //有配置信息 更新记录
                $mdlTbo2oShop->update($sql_arr,$filter_arr);
            }
        }
        die('1');
    }
}
