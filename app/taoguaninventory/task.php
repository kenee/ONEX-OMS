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

class taoguaninventory_task{

    function post_install($options){
        //初始化盘点的码表
        $encodedStateObj = app::get('taoguaninventory')->model('encoded_state');
        $state_data = array(
            'name' => 'inventory',
            'head' => 'PD',
            'currentno' => 0,
            'bhlen' => 4,
            'description' => '盘点表',
        );
        $encodedStateObj->save($state_data);
    }

}
