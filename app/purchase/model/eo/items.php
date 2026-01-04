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

class purchase_mdl_eo_items extends dbeav_model{


    /*
     * 返回可退值
     * @param item_id
     */
    function Get_num($item_id){
        $item = $this->dump($item_id,'entry_num,out_num');
        return $item['entry_num']-$item['out_num'];
    }
}

?>
