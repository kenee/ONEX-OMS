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

class console_mdl_delivery_extension extends dbeav_model{

    
    
    function create($data){
        
        $delivery_bn = $data['delivery_bn'];
        $original_delivery_bn = $data['original_delivery_bn'];
        $extension = $this->dump(array('delivery_bn'=>$data['delivery_bn']));

        if(!$extension){
            $SQL = "INSERT INTO sdb_console_delivery_extension(delivery_bn,original_delivery_bn) VALUES('$delivery_bn','$original_delivery_bn')";

            $this->db->exec($SQL);
        }
    }

}