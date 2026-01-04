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

/**
 * 更新商品上下架，RPC实现类
 *
 * @author chenping<chenping@shopex.cn>
 */

class inventorydepth_ecck_rpc_request_frame extends ome_rpc_request {

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 更新商品上下架
     *
     * @param Array $approve_status 上下架参数
     * @param String $shop_id 店铺ID
     * @return Array
     **/
    public function approve_status_list_update($approve_status,$shop_id)
    {
    }
}
