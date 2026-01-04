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

class erpapi_store_response_process_order
{
    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function add($params){
        
        $params['method'] = 'ome.order.add';

       
        $rs = kernel::single('erpapi_router_response')->set_node_id($params['node_id'])->set_api_name('ome.order.add')->dispatch($params);
     
        return $rs;

    }

    /**
     * refundagree
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function refundagree($params){

        $rs = kernel::single('openapi_data_original_order')->refundagree($params);
     
        return $rs;

    }

    /**
     * returnagree
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function returnagree($params){

        $rs = kernel::single('openapi_data_original_order')->returnagree($params);
        return $rs;

    }

}

?>