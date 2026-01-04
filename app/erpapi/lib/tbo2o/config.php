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
 * 淘宝o2o接口配置类
 *
 * @author xiayuanjun<xiayuanjun@shopex.cn>
 * wangjianjun update 20160623
 * @version 0.1
 */
class erpapi_tbo2o_config extends erpapi_config
{
    /**
     * 应用级参数
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @return void
     * @author 
     **/
    public function get_query_params($method, $params){
        $query_params = array(
            'api'       => $method,
            'format'       => 'json',
            'from_node_id' => base_shopnode::node_id('ome'),
            'to_node_id'   => $this->__channelObj->tbo2o['node_id'],
        );
        if(in_array($method,$this->_top_list)){
            //走top的接口
            $query_params['method']    = 'store.common.top.send';
            $query_params["v"] = "1.0";
            $query_params["certi_id"] = base_certificate::certi_id();
            $query_params["app_id"] = "ecos.ome";
        }else{
            //走奇门的接口
            $query_params['method'] = 'store.common.qimen.send';
            $query_params['tb_version'] = "1.0";
        }
        return $query_params;
    }
    
    private $__global_whitelist = array(
        QIMEN_STORE_CREATE,
        QIMEN_STORECATEGORY_GET,
        QIMEN_STORE_UPDATE,
        QIMEN_STORE_DELETE,
        QIMEN_STORE_QUERY,
        QIMEN_ITEMSTORE_BANDING,
        QIMEN_ITEMSTORE_QUERY,
        QIMEN_STOREITEM_QUERY,
        SCITEM_ADD,
        SCITEM_MAP_ADD,
        QIMEN_STOREINVENTORY_ITEMINITIAL,
        QIMEN_STOREINVENTORY_ITEMUPDATE,
    );
    
    private $_top_list = array('taobao.scitem.add', 'taobao.scitem.update', 'taobao.scitem.query', 'taobao.scitem.map.add', 'taobao.scitem.map.delete');
    
}