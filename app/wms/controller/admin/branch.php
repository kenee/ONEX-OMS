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

class wms_ctl_admin_branch extends desktop_controller{

    var $name = "仓储";
    var $workground = "storage_center";

    /*货品上架*/

    public function addPos(){
        $branchObj = app::get('ome')->model('branch');
        kernel::single('desktop_user')->get_conf('pos.setting',$pos_setting);
        $this->pagedata['display_type'] = $pos_setting ? $pos_setting:'wap_barcode';
        $branch_id = kernel::single('wms_branch')->getBranchByselfwms();

        $branchs = $branchObj->getList('*',array('wms_id'=>$branch_id),0,-1);

        if(app::get('ome')->getConf('ome.branch.mode')=='single' || count($branchs)<=1 || $_POST['branch_id'] || $_GET['branch_id']){
            $branch_id = isset($_POST['branch_id'])?$_POST['branch_id']:$branchs[0]['branch_id'];
            $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:$branch_id;
            $branch = $branchObj->dump(array('branch_id'=>$branch_id), '*');
            $this->pagedata['branch'] = $branch;
            $this->pagedata['op_name'] = kernel::single('desktop_user')->get_name();
            $this->pagedata['curTime'] = date("Y-m-d",time());
            $this->page("admin/branch/tidy.html");
        }else{
            $this->pagedata['branchs'] = $branchs;
            $this->page("admin/branch/branch.html");
        }
    }

    /**
     * do_addPos
     * @return mixed 返回值
     */
    public function do_addPos()
   {
       $libBranchProductPos    = kernel::single('ome_branch_product_pos');
       
        $branch_id = $_POST['branch_id'];
        $product_id = $_POST['product_id'];
        $from_pos_id = $_POST['from_pos_id'];
        
        $nums = $libBranchProductPos->get_bps_nums($product_id);
        if($nums>3 && !isset($_POST['bind']))
        {
            $msg = '货品关联货位过多，不利于仓库的货物管理，确认关联新货位么？';
            echo json_encode(array(false, $msg));
            exit;
        }
        
        if(!empty($from_pos_id))
        {
            $return = $libBranchProductPos->create_branch_pos($product_id, $branch_id, $from_pos_id);
            if($return){
                $msg = '货品(Id:'.$product_id.')已上架至货位(Id:'.$from_pos_id.')成功!';
            }else{
                $msg = '上架失败!';
            }
        } else {
            $msg = '上架失败!';
        }
        echo json_encode(array(true,$msg));
        exit;
    }

}


?>