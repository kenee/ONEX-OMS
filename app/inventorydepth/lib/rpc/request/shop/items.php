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
 * 店铺ITEM接口
 *
 * @author chenping<chenping@shopex.cn>
 */

class inventorydepth_rpc_request_shop_items {

   public function __construct($app)
    {
        //$identity = $app->getConf('inventorydepth.system.identity');
        $identity = app::get('inventorydepth')->runtask('getIdentity');

        $this->object = kernel::single("inventorydepth_{$identity}_rpc_request_shop_items");
    }

    public function __call($method,$arguments)
    {
        return call_user_func_array(array($this->object,$method), $arguments);
    }
}
