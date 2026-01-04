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

class ome_mdl_tbgift_goods extends dbeav_model{
    var $has_many = array(
        'product' => 'tbgift_product:replace'
    );

    function getGiftById($id){
        return $this->db->select("SELECT * FROM sdb_ome_tbgift_goods where goods_id = '".$id."'");
    }

    function checkGiftByBn($bn){
        return $this->db->select("SELECT goods_id FROM sdb_ome_tbgift_goods where gift_bn = '".addslashes($bn)."'");
    }

    function getGiftByBn($bn){
        return $this->db->selectrow("SELECT goods_id FROM sdb_ome_tbgift_goods where gift_bn = '".addslashes($bn)."'");
    }
}
?>