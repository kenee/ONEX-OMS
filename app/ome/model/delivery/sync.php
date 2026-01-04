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
 +----------------------------------------------------------
 * 发货单回写状态列表数据
 +----------------------------------------------------------
 *
 * Time: 2014-07-16 $
 * [Ecos!] (C)2003-2014 Shopex Inc.
 +----------------------------------------------------------
 */


class ome_mdl_delivery_sync extends dbeav_model
{
    /*------------------------------------------------------ */
    //-- 获取列表数据[自定义]
    /*------------------------------------------------------ */

    public function getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null)
    {
        if(empty($orderType))$orderType = "dateline DESC";

        return parent::getList('*',$filter,$offset,$limit,$orderType);
    }
}
?>