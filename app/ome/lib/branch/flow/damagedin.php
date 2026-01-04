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

class ome_branch_flow_damagedin extends ome_branch_flow_abstract implements ome_branch_flow_interface
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function getContent($id)
    {
        $flow = app::get('ome')->model('branch_flow')->dump($id);
        $content = (array)json_decode($flow['content'], 1);
        $content['branch_id'] = $content['branch_id'] ? : [];
        $branchList = app::get('ome')->model('branch')->getList('branch_id,name',[
            'b_type' => '1',
            'type' => 'damaged',
            'check_permission' => 'false',
        ]);

        foreach ($branchList as $key => $value) {
            $branchList[$key]['checked'] = in_array($value['branch_id'], $content['branch_id']);
        }


        $render = app::get('ome')->render();

        $render->pagedata['branchList'] = $branchList;

        return $render->fetch('admin/branch/flow/damagedin.html');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function getBranchId()
    {
        $flow = app::get('ome')->model('branch_flow')->dump([
            'flow_type' => 'damagedin',
        ]);
        $content = (array)json_decode($flow['content'], 1);

        return $content['branch_id'];
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function translateContent($content)
    {
        $content = (array)json_decode($content, 1);

        $branchList = app::get('ome')->model('branch')->getList('branch_id,name',[
            'b_type' => '1',
            'type' => 'damaged',
            'check_permission' => 'false',
            'branch_id' => $content['branch_id']
        ]);

        return implode('，', array_column($branchList, 'name'));
    }
}
