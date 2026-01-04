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

/*
 * 淘宝全渠道公共类
 */
class tbo2o_common{
    
   //获取阿里全渠道主店铺信息
    /**
     * 获取Tbo2oShopInfo
     * @return mixed 返回结果
     */
    public function getTbo2oShopInfo(){
       $mdlTbo2oShop = app::get('tbo2o')->model('shop');
       $rs_tbo2o_shop = $mdlTbo2oShop->getList("*",array(),0,1);
       return $rs_tbo2o_shop[0];
   }
   
   //获取阿里全渠道服务端信息
    /**
     * 获取Tbo2oServerInfo
     * @return mixed 返回结果
     */
    public function getTbo2oServerInfo(){
       $mdlO2oServer = app::get('o2o')->model('server');
       $rs_o2o_server = $mdlO2oServer->dump(array("type"=>"taobao"));
       return $rs_o2o_server;
   }
   
}
