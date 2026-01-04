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


class ome_operation_organization{

    /**
     * 获取OrgOps
     * @param mixed $org_id ID
     * @return mixed 返回结果
     */
    public function getOrgOps($org_id){
        if(!$org_id){
            return array();
        }

        $ops = array();
        $orgOpsObj = app::get('ome')->model("operation_ops");
        $orgOpsInfo = $orgOpsObj->getList('*', array('org_id' => $org_id), 0, -1);
        if($orgOpsInfo){
            foreach($orgOpsInfo as $opInfo){
                $ops[] = $opInfo['op_id'];
            }
            
            return $ops;
        }else{
            return array();
        }
    }

}