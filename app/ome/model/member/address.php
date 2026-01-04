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

class ome_mdl_member_address extends dbeav_model{

    /**
     * 创建_address
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    public function create_address($data){
        $member_id = $data['member_id'];
        if($member_id){
            $address_hash = sprintf('%u',crc32($data['ship_name'].'-'.$data['ship_area'].$data['ship_addr'].'-'.$data['ship_mobile'].'-'.$data['ship_tel'].'-'.$data['ship_zip'].'-'.$data['ship_email']));
            $data['address_hash'] = $address_hash;
            $address_detail = $this->dump(array('address_hash'=>$address_hash,'member_id'=>$member_id),'address_id');
            if(!$address_detail['address_id']){
                $result = $this->save($data);
            }
            
            if($data['is_default'] == '1' && $data['address_id']){
                $this->db->exec("UPDATE sdb_ome_member_address SET is_default='0' WHERE member_id=".$data['member_id']." AND address_id!=".$data['address_id']);
                $this->db->exec("UPDATE sdb_ome_members SET  area='".$data['ship_area']."',addr='".$data['ship_addr']."',mobile='".$data['ship_mobile']."',tel='".$data['ship_tel']."',email='".$data['ship_email']."', zip='".$data['ship_zip']."' WHERE member_id=".$data['member_id']);
            }
        }
        
    }
}
