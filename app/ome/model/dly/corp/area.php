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

class ome_mdl_dly_corp_area extends dbeav_model{

    function get_corp_area($corp_id,$areaGroupId){
        $corp=$this->getList('region_id',array('corp_id'=>$corp_id));
        $areaGroup=explode(",",$areaGroupId);
        $areaGroup = kernel::single('ome_region')->get_region_node($areaGroup);
        foreach($corp as $k=>$v){
            if(in_array($v,$areaGroup)==false){
                $this->Del_corp_area($corp_id,$v['region_id']);
            }
        }
        foreach($areaGroup as $key=>$value){
            if($value!=''){
                $sdf_area = array(
                    'corp_id'=>$corp_id,
                    'region_id'=>$value
                );
            $this->save($sdf_area);
            }
        }

    }
    function Del_corp_area($corp_id,$region_id){
        $this->db->exec('DELETE FROM sdb_ome_dly_corp_area WHERE corp_id='.$corp_id.' AND region_id='.$region_id);
    }
    
    function getCorpByRegionId($region_id){
        $sql = "SELECT dc.corp_id,dc.name FROM sdb_ome_dly_corp_area dca JOIN sdb_ome_dly_corp dc ON dca.corp_id=dc.corp_id WHERE dca.region_id=".$region_id;
        return $this->db->select($sql);
    }

}

?>
