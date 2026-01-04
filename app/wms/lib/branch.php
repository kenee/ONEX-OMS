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

class wms_branch{

    /*
     * 获取操作员管辖仓库
     * 
     */

    function getBranchwmsByUser($is_super, $selfwms = true) {

        $oBranch = app::get('ome')->model('branch');
        $oBops = app::get('ome')->model('branch_ops');
        $filter = array();   
        if(!$is_super){
            $opInfo = kernel::single('ome_func')->getDesktopUser();
            $op_id = $opInfo['op_id'];
            $bops_list = $oBops->getList('branch_id', array('op_id' => $op_id), 0, -1);
            if ($bops_list)
            foreach ($bops_list as $k => $v) {
                $bps[] = $v['branch_id'];
            }
            $filter['branch_id'] = $bps;
            if(!$bps){
                return [];
            }
        }
        
        if ($selfwms) {
            $filter['wms_id'] = $this->getBranchByselfwms();
        }

        $branch_list = $oBranch->getList('branch_id', $filter, 0, -1);

        $branch_ids = array();
        if ($branch_list)
        foreach ($branch_list as $branch_list) {
            $branch_ids[] = $branch_list['branch_id'];

        }
        return $branch_ids;
    }

    /**
     * 返回主仓和售后仓
     */
    function getBranchs($field='*') {
        $rows = $this->db->select('select ' . $field . ' from sdb_ome_branch where attr="true"  AND `type` in (\'main\',\'damaged\') order by weight desc');

        return $rows;
    }

    /**
     * 获取自有仓储仓库
     */
    function getBranchByselfwms(){
        $wms_list = kernel::single('channel_func')->getWmsChannelList();
        
        $self_wmslist = array();
        foreach($wms_list as $wms){
            if ($wms['adapter']=='selfwms'){
                $self_wmslist[]=$wms['wms_id'];
            }
        }
        
        return $self_wmslist;
    }

    
}
