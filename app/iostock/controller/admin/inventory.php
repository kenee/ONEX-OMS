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

class iostock_ctl_admin_inventory extends desktop_controller{
    public $name = "出入库管理";
    public $workground = "iostock_center";

    /**
     * index
     * @return mixed 返回值
     */
    public function index(){
        $this->title = '盘点差异过账';
        $finder_cols = "branch_id,iostock_bn,bn,column_name,type_id,nums,iostock_price,column_amount,operator,create_time,memo";
//仓库，出入库单号，商品货号、(商品名称)、出入库类型、亏盈数量、商品单价、(亏盈金额)、盘点人、盘点时间、备注
        $filter = array('type_id'=>array('6','60'),'iostock_bn'=>array($_SESSION['bn_more'],$_SESSION['bn_less']));
        unset($_SESSION['bn_more']);
        unset($_SESSION['bn_less']);
        $params = array(
            'title'=>$this->title,
            'base_filter' => $filter,
            'use_buildin_recycle'=>false,
            'use_buildin_import'=>true,
            'orderBy' => 'create_time desc',
            'finder_cols'=>$finder_cols,
        );
        $this->finder('iostock_mdl_inventory',$params);
    }

    function exportTemplate(){
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=inventory.csv");
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        $pObj = $this->app->model('inventory');
        $title1 = $pObj->exportTemplate('main');
        $title2 = $pObj->exportTemplate('item');
        echo '"'.implode('","',$title1).'"';
        echo "\n\n";
        echo '"'.implode('","',$title2).'"';
    }
}