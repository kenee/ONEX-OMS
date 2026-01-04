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

class taoguanallocate_mdl_appropriation_items extends dbeav_model{

    /**
     * 获取OrderIdByPbn
     * @param mixed $product_bn product_bn
     * @return mixed 返回结果
     */
    public function getOrderIdByPbn($product_bn){
        $sql = 'SELECT appropriation_id FROM sdb_taoguanallocate_appropriation_items WHERE bn like \''.addslashes($product_bn).'%\'';
        $rows = $this->db->select($sql);
        return $rows;
    }

    /**
     * 获取OrderIdByPbarcode
     * @param mixed $product_barcode product_barcode
     * @return mixed 返回结果
     */
    public function getOrderIdByPbarcode($product_barcode)
    {
        $sql = "SELECT I.appropriation_id 
                FROM sdb_taoguanallocate_appropriation_items as I 
                LEFT JOIN sdb_material_codebase as c ON I.product_id=c.bm_id 
                WHERE c.code like '". addslashes($product_barcode) ."%' AND c.type=1";
        $rows = $this->db->select($sql);
        return $rows;
    }
   
}