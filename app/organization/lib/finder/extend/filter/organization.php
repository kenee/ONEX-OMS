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

class organization_finder_extend_filter_organization{
     function get_extend_colums(){

        $mdlOrganization = app::get('organization')->model('organization');
        //get org level arr
        $sql_str = "SELECT org_level_num FROM sdb_organization_organization WHERE del_mark<>1 and org_type=1 GROUP BY org_level_num";
        $result_rows = $mdlOrganization->db->select($sql_str);
        $arr_org_level_num_list = array();
         foreach ($result_rows as $var_item){
             $arr_org_level_num_list[$var_item['org_level_num']] = $var_item['org_level_num'];
         }
        
        $db['organization']=array (
            'columns' => array (
               'status' =>
                    array (
                    'type' => $mdlOrganization->org_status,
                    'editable' => false,
                    'label' => '状态选择',
                    'width' => 100,
                   'filtertype' => 'normal',
                    'filterdefault' => true,
                    'in_list' => true,
                    'panel_id' => 'organization_finder_top',
                ),
               'org_level_num' =>
                    array (
                    'type' => $arr_org_level_num_list,
                    'editable' => false,
                    'label' => '组织层级选择',
                    'width' => 100,
                   'filtertype' => 'normal',
                    'filterdefault' => true,
                    'in_list' => true,
                    'panel_id' => 'organization_finder_top',
                ),
            )
        );
        return $db;
     }
}
