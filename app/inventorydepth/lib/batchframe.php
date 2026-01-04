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

class inventorydepth_batchframe {
    const EXPIRED_TIME = 1800;
    /**
     * @description
     * @access public
     * @param void
     * @return void
     */
    public function is_expired(&$downloadTime='') 
    {  
        base_kvstore::instance('inventorydepth/batchframe')->fetch('downloadTime'.$_SESSION['shop_id'],$downloadTime);
        if ($downloadTime) {
            $result = $downloadTime > (time()-self::EXPIRED_TIME) ? false : true;

            return $result;
        } else {
            return true;
        }
    }
}
