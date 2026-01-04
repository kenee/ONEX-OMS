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

class omeauto_mdl_autodispatch extends dbeav_model{
    /**
     *
     * 分派规则回收站删除后删除订单分组记录上的分派规则id
     * @param int $did
     */
    function suf_delete($did){
        $orderTypeObj = app::get('omeauto')->model('order_type');
        $orderTypeObj->update(array('did'=>0),array('did'=>$did));
        return true;
    }
}