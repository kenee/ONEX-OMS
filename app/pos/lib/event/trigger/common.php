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

class pos_event_trigger_common
{
    
    
    /**
     * 获取ChannelId
     * @param mixed $node_type node_type
     * @return mixed 返回结果
     */
    public function getChannelId($node_type){
       $storeMdl = app::get('o2o')->model('store');
       $stores = $storeMdl->db->selectrow("SELECT s.store_id,v.server_id FROM sdb_o2o_store as s LEFT JOIN sdb_o2o_server as v on s.server_id=v.server_id WHERE v.node_type='".$node_type."'");
       return $stores;
    }



}
