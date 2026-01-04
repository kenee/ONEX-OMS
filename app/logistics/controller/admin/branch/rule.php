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

class logistics_ctl_admin_branch_rule extends desktop_controller {
        var $workground = 'setting_tools';
        var $defaultWorkground = 'setting_tools';

        /**
         * 仓库对应规则列表
         */
        function saveBranchRule(){
            $data = $_POST;
            $branch_id = $data['branch_id'];
            $set_rule = $data['set_rule'];
            if($data){
                #保存信息至物流设置主表

                $result = $this->app->model('branch_rule')->create($data);

                $this->splash('success','index.php?app=logistics&ctl=admin_rule&act=ruleList&branch_id='.$branch_id,'保存成功');
            }





        }


    }

?>