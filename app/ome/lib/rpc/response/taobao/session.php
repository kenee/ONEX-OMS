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


class ome_rpc_response_taobao_session extends ome_rpc_response
{
    
    /**
     * 淘宝登录状态更新
     * @param array $session_sdf 
     * @param string $node_id 节点ID
     * @return null
     */
    function status($session_sdf){

        //状态，true:正常  false:失败
        $status = $session_sdf['status'];
        //淘宝session
        $session = $session_sdf['session'];
        //昵称：淘宝帐号
        $nickname = $session_sdf['nickname'];
        $node_id = base_rpc_service::$node_id;
        
        // 更新addon字段
        $shopObj = app::get('ome')->model('shop');
        $data = array('session'=>$session, 'nickname'=>$nickname);
        $filter = array('node_id'=>$node_id);
        $shopinfo = $shopMdl->getList('addon',$filter);

        if(is_array($shopinfo) && count($shopinfo)>0){
            if ($addon = $shopinfo[0]['addon'] ) {
                $newaddon['addon'] = array_merge($addon,$data);
            }
        }else{
            $newaddon['addon'] = $data;
        }
        $shopObj->update($newaddon, $filter);
        
        // 更新KVSTORE登录状态
        app::get('ome')->setConf('taobao_session_'.$node_id, $status);
    }
    
}
?>