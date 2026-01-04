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

class erpapi_system_response_process_msg
{
    /**
     * notify
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function notify($sdf)
    {
        if (!$sdf['node_id']) {
            array('rsp' => 'fail', 'msg' => '节点不能为空');
        }
        
        $shopMdl = app::get('ome')->model('shop');
        
        $shop = $shopMdl->dump(array('node_id' => $sdf['node_id']), 'shop_id,addon,name');
        
        if (!$shop) {
            array('rsp' => 'fail', 'msg' => '店铺未绑定');
        }
        
        $rpcNotifyMdl = app::get('base')->model('rpcnotify');
        $sdf['content']['info'] = '【' . $shop['name'] . '】' . $sdf['content']['info'];
        $data         = [
            'callback'   => '',
            'rsp'        => 'succ',
            'msg'        => json_encode($sdf['content'],JSON_UNESCAPED_UNICODE),
            'notifytime' => strtotime($sdf['date'])
        ];
        $rpcNotifyMdl->insert($data);
       
        // 店铺到期主动提醒
        kernel::single('monitor_event_notify')->addNotify('system_message', [
            'errmsg'         => $sdf['content']['info'],
        ]);

        return array('rsp' => 'succ', 'msg' => '消息已接收');
    }
}
