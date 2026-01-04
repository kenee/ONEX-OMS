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

class pos_event_trigger_replenish
{
    /**
     *
     * 订货单审批
     * @param 
     */
    public function check($sug_id)
    {

        
        $suggestMdl = app::get('console')->model('replenish_suggest');

        $suggests = $suggestMdl->dump(array('sug_id'=>$sug_id),'task_bn,branch_id');
        $store_id = kernel::single('ome_branch')->isStoreBranch($suggests['branch_id']);
        $params = array(
            'task_bn'      =>  $suggests['task_bn'],
            
        );

        $channel_type = 'store';
        $channel_id = $store_id;

        $result = kernel::single('erpapi_router_request')->set($channel_type,$channel_id)->replenish_check($params);


        if($result['rsp'] == 'succ'){
            $updateData = array(
                'sync_status'=>'1',

            );
            $rs = [true,'成功'];
        }else{
            $updateData = array(
                'sync_status'=>'2',

            );
            $rs = [false,'失败'];
        }
        $suggestMdl->update($updateData,array('store_id'=>$store_id));
        return $rs;
    }
    
  
}
