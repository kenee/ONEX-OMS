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

class wmsmgr_finder_smart
{
    var $addon_cols = "channel_id,channel_name,node_id,channel_type,node_type,config";
    
    var $column_edit = "操作";
    var $column_edit_width = "260";
    var $column_edit_order = "1";
    function column_edit($row)
    {
        $finder_id = $_GET['_finder']['finder_id'];
        $node_type = $row[$this->col_prefix.'node_type'];
        $node_id = $row[$this->col_prefix.'node_id'];
        $channel_id = $row[$this->col_prefix.'channel_id'];
        
        $config = unserialize($row[$this->col_prefix . 'config']);
        
        //url
        $url = 'index.php?app=wmsmgr&ctl=admin_smart';
        
        //adapter
        $adapter = kernel::single('wmsmgr_func')->getAdapterByChannelId($channel_id);
    
        //callback url
        $sess_id = kernel::single('base_session')->sess_id();
        $callback_url = urlencode(kernel::openapi_url('openapi.wmsmgr','bindCallback',array('channel_id'=>$channel_id, 'sess_id'=>$sess_id)));
        
        //api url
        $api_url = kernel::base_url(true).kernel::url_prefix().'/api';
        
        //button
        $edit_btn = '<a href="'. $url .'&act=edit&p[0]='.$row[$this->col_prefix.'channel_id'].'&finder_id='.$finder_id.'" target="dialog::{width:500,height:400,title:\'编辑报价系统授权\'}">编辑</a>';
        
        $bind_btn = '';
        $app_id = "ome";
        $api_url = urlencode($api_url);
        if (in_array($adapter,array('matrixwms'))) {
            switch ($config['node_type']) {
                case 'other':
                default:
                    $bind_btn .= empty($node_id) ?
                ' | <a href="'. $url .'&act=apply_bindrelation&p[0]='.$app_id.'&p[1]='.$callback_url.'&p[2]='.$api_url.'" target="_blank">申请绑定</a>' : ' | 已绑定';
                break;
            }
        }
        
        if(in_array($adapter, array('matrixwms','mixturewms'))){
            return $edit_btn.$bind_btn;
        }else{
            return $edit_btn;
        }
    }
}
