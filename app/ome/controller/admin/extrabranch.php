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

class ome_ctl_admin_extrabranch extends desktop_controller{
    var $name = "仓库管理";
    var $workground = "goods_manager";

    function index(){
       
        $actions = array(
			         array('label'=>'添加外部仓库','href'=>'index.php?app=ome&ctl=admin_extrabranch&act=addbranch&singlepage=false&finder_id='.$_GET['finder_id'],'target'=>'_blank'),
        );
        
        $params = array(
			         'title'=>'外部仓库设置',
            'actions'=>$actions,
            'use_buildin_new_dialog'=>false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>false,
            'use_buildin_export'=>false,
            'use_buildin_import'=>false,
            
       );
	   
       $this->finder('ome_mdl_extrabranch',$params);
    }
     /*
     * 外部仓库添加
     *
     * @param int $branch_id
     *
     */
    function addbranch(){
        $oExtrabranch = $this->app->model("extrabranch");
        if($_POST){
            $this->begin('index.php?app=ome&ctl=admin_extrabranch&act=index');
            
            $data = $_POST;
			
            //新增、编辑
            if($data['branch_bn']){
                $filter_branch_bn = array('branch_bn'=>$data['branch_bn']);
                if($data['branch_id']){ //编辑
                    $filter_branch_bn = array("branch_bn"=>$data["branch_bn"],"branch_id|noequal"=>$data['branch_id']);
                }
                $extrabranch_bn = $oExtrabranch->dump($filter_branch_bn,'branch_id');
                if(!empty($extrabranch_bn)){
                    $this->end(false,'外部仓库编码已存在!');
                }
            }
            
            if( empty($data['branch_id']) ){
                $extrabranch = $oExtrabranch->dump(array('name'=>$data['name']),'branch_id');
                if(!empty($extrabranch)){
                    $this->end(false,'外部仓库已存在!');
                }elseif(empty($data['mobile']) && empty($data['phone'])){
                    $this->end(false,'手机和固定电话必须填写一项!');
                }

                if($oExtrabranch->insert($data)){
                    $this->end(true,'保存成功!');
                }else{
                    $this->end(false,'保存失败!');
                }
            }else{
                if($oExtrabranch->update($data,array('branch_id'=>$data['branch_id']))){
                    $this->end(true,'保存成功!');
                }else{
                    $this->end(false,'保存失败!');
                }
            }
       }

        $this->pagedata['title'] = '添加外部仓库';
        $this->singlepage("admin/extrabranch/branch.html");
    }

    /*
     * 外部仓库编辑
     *
     * @param int $branch_id
     *
     */
    function editbranch($branch_id=null, $singlepage=false){
        $oExtrabranch = $this->app->model("extrabranch");
        

        $extrabranch = $oExtrabranch->dump(array('branch_id'=>$branch_id), '*');
  

        $this->pagedata['extrabranch'] = $extrabranch;
        $this->pagedata['title'] = '编辑外部仓库';
        if ($singlepage==false){
			         $this->page("admin/extrabranch/branch.html");
		      }else{
			         $this->singlepage("admin/extrabranch/branch.html");
		      }
    }

    

}
?>
