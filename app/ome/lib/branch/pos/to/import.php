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

class ome_branch_pos_to_import {

    function run(&$cursor_id,$params){

        $bpObj = app::get($params['app'])->model($params['mdl']);
        $branchObj = app::get('ome')->model('branch');
        $Sdf = array();
        $bp = array();
        $Sdf = $params['sdfdata'];

        foreach ($Sdf as $v){
            
            $bp = array();
            //获取仓库ID
            $branch = $branchObj->dump(array('name'=>trim($v[1])), 'branch_id');
            if ($branch['branch_id']){
                $bp['store_position'] = $v[0];
                $bp['branch_id'] = $branch['branch_id'];
                $bpObj->save($bp);
            }
        }
        return false;
    }
}
