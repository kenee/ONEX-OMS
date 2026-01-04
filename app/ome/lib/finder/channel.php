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

class ome_finder_channel{
    var $column_edit = '操作';
    var $column_edit_width = "100";
    /**
     * column_edit
     * @param mixed $row row
     * @return mixed 返回值
     */
    public function column_edit($row){
        $channel_id = $row['channel_id'];
        $finder_id = $_GET['_finder']['finder_id'];
        $obj_channel = app::get('ome')->model('channel');
        $node_id = $obj_channel->getList('node_id',array('channel_id'=>$channel_id));
        $bind = null;
        if(empty($node_id[0]['node_id'])){
            #节点为空,申请绑定
            $bind = '&nbsp;|&nbsp;<a href="index.php?app=ome&ctl=admin_channel_channel&act=apply_bindrelation&channel_id='.$channel_id.'&finder_id='.$finder_id.'" target="_blank">申请绑定</a>';
        }
        return  '<a href="index.php?app=ome&ctl=admin_channel_channel&act=editChannel&channel_id='.$row['channel_id'].'&finder_id='.$finder_id.'" target="dialog::{width:420,height:280,title:\'编辑绑定应用\'}">编辑</a>'.$bind;
    }
    var $detail_basic = '基本信息';
    function detail_basic($channel_id){
        $obj_channel = app::get('ome')->model('channel');
        $data = $obj_channel->getList('channel_bn,channel_name,channel_type,memo',array('channel_id'=>$channel_id));
        if($data[0]['channel_type'] == '1'){
            $data[0]['channel_type']= 'crm';
        }
        $render = app::get('ome')->render();
        $render->pagedata['data'] = $data[0]; 
        return $render->fetch('admin/channel/detail_basic.html');
    }
}