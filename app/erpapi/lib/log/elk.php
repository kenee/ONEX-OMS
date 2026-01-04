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

class erpapi_log_elk{

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function write_log($logsdf,$step='request')
    {
        $message = array(
            'spendtime'   => $logsdf['spendtime'],
            'title'       => $logsdf['title'],
            'method'      => $logsdf['method'],
            'original_bn' => $logsdf['original_bn'],
            'msg_id'      => $logsdf['msg_id'],
            'status'      => $logsdf['status'],
            'createtime'  => $logsdf['createtime'],
            'step'        => $step,
            'node_id'     => base_shopnode::node_id('ome'),
            'domain'      => $_SERVER['HTTP_HOST'],
            'type'        => 'api',
            'data'        => json_encode($logsdf['data']),
        );

        $message = json_encode($message);

       if (defined('API_RAKAFKA_SERVER') && constant('API_RAKAFKA_SERVER')) {
            $topic = defined('API_RAKAFKA_TOPIC') && constant('API_RAKAFKA_TOPIC') ? constant('API_RAKAFKA_TOPIC') : 'erp';

            kernel::single('base_queue_rdkafka')->set_server(API_RAKAFKA_SERVER)->publish($message,$topic);
       }
    }
}
