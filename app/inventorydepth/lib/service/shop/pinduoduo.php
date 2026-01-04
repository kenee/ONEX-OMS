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
* 
* 拼多多商品同步
* 
*/
class inventorydepth_service_shop_pinduoduo extends inventorydepth_service_shop_common
{
    //定义每页拉取数量
    public $customLimit = 5;

    public $approve_status = array(
            array('filter'=>array('approve_status'=>'onsale'),'name'=>'在架','flag'=>'onsale'),
            array('filter'=>array('approve_status'=>'instock'),'name'=>'下架','flag'=>'instock'),

    );
    function __construct(&$app)
    {
        $this->app = $app;
    }
}