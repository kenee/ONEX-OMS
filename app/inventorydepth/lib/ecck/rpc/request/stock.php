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
* 更新库存RPC接口实现
*
* @author chenping<chenping@shopex.cn>
* @version 2012-5-30 18:04
*/
class inventorydepth_ecck_rpc_request_stock extends ome_rpc_request
{

    function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * 前端店铺更新库存
     *
     * @param Array $stocks 矩阵更新库存结构
     * @param String $shop_id 店铺ID
     * @param Array $addon 附加参数
     *
     **/
    public function stock_update($stocks,$shop_id,$addon='')
    {

    }
}