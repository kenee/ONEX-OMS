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


class ome_service_delivery_bindkey{
    
    /**
     * 获取合并条件值
     * @param sdf $sdf
     * @return string md5
     */
    public function get_bindkey($sdf){
        $bindkey = md5($sdf['shop_id'].$sdf['branch_id'].$sdf['consignee']['addr'].$sdf['member_id'].$sdf['is_cod'].$sdf['is_protect']);
        return $bindkey;
    }
    
}