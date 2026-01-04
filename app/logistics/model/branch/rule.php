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

class logistics_mdl_branch_rule extends dbeav_model{

    /**
     * 保存物流公司仓库表
     * 更新规则表
     */
    function create($data){
        $branch_rule = $this->dump(array('branch_id'=>$data['branch_id']),'type');

        $type = $branch_rule['type'];
        $rule_data = array();
        $rule_data['branch_id'] = $data['branch_id'];
        $rule_data['type']= $data['set_rule'];


        $result = $this->save($rule_data);



        if($type!=$data['set_rule']){
            if($data['set_rule']=='custom'){
                $this->db->exec('UPDATE sdb_logistics_branch_rule SET parent_id=0 WHERE branch_id='.$data['branch_id']);
            }else if($data['set_rule']=='other'){
                #删除自定义规则
                $this->app->model('rule')->deleteRule('','','',1,$data['branch_id']);
                $this->db->exec('DELETE FROM sdb_logistics_rule WHERE branch_id='.$data['branch_id']);

            }

        }

        return $data['branch_id'];

    }


    /**
     * 获取父级仓库ID
     */
    function getBranchRuleParentId($branch_id,&$parent_id){
        $branch_rule = $this->app->model('branch_rule')->getlist('type,parent_id,branch_id',array('branch_id'=>$branch_id));

        if($branch_rule[0]['parent_id']!=0){
            $parent_id=$branch_rule[0]['parent_id'];

            $this->getBranchRuleParentId($branch_rule[0]['parent_id'],$parent_id);
        }
       return $parent_id;
    }
}
?>