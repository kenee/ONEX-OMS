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

class ome_branch_view extends desktop_controller{
    
    /**
     * 获取BranchView
     * @param mixed $branch_id ID
     * @param mixed $url url
     * @param mixed $title title
     * @param mixed $method method
     * @return mixed 返回结果
     */
    public function getBranchView($branch_id, $url, $title='查看', $method='GET'){
        //$render = app::get('ome')->render();
        if ($branch_id){
            $this->pagedata['branch_id'] = $branch_id;
            return $branch_id;
        }else {
            $oBranch = app::get('ome')->model('branch');
            $is_super = kernel::single('desktop_user')->is_super();
            $branch_ids = $oBranch->getBranchByUser(true);
            if (!$is_super){
                $branch_ids = $oBranch->getBranchByUser(true);
                if ($branch_ids){
                    if (count($branch_ids) > 1){
                        $this->pagedata['branch_list'] = $branch_ids;
                        $this->pagedata['name'] = $title;
                        $this->pagedata['url'] = $url;
                        $this->pagedata['method'] = $method;
                        $this->page("admin/branch/exist_branch.html");
                        exit;
                    }else {
                        $this->pagedata['branch_id'] = $branch_ids[0]['branch_id'];
                        return $branch_ids[0]['branch_id'];
                    }
                }else{
                    $this->pagedata['name'] = $title;
                    $this->pagedata['url'] = $url;
                    $this->pagedata['method'] = $method;
                    $this->page("admin/branch/exist_branch.html");
                    exit;
                }
            }else {
                $branch_ids = $oBranch->getList('branch_id,name,uname,phone,mobile','',0,-1);
                if ($branch_ids){
                    if (count($branch_ids) > 1){
                        $this->pagedata['branch_list'] = $branch_ids;
                        $this->pagedata['name'] = $title;
                        $this->pagedata['url'] = $url;
                        $this->pagedata['method'] = $method;
                        $this->page("admin/branch/exist_branch.html");
                        exit;
                    }else {
                        $this->pagedata['branch_id'] = $branch_ids[0]['branch_id'];
                        return $branch_ids[0]['branch_id'];
                    }
                }else{
                    $this->pagedata['name'] = $title;
                    $this->pagedata['url'] = $url;
                    $this->pagedata['method'] = $method;
                    $this->page("admin/branch/exist_branch.html");
                    exit;
                }
            }
        }
    }
}