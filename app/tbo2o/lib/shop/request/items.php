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

/**
 * RPC接口实现类
 * 
 * @author wangbiao@shopex.cn
 * @version 0.1
 */
class tbo2o_shop_request_items extends ome_rpc_request
{
    /**
     * @description
     * @access public
     * @param void
     * @return void
     */
    public function __construct() 
    {
    }

    public function get_err_msg(){
        return $this->err_msg;
    }

    public function set_err_msg($err_msg){
        return $this->err_msg = $err_msg;
    }

    /**
     * 实时下载店铺商品
     *
     * @param Array $filter 筛选条件(approve_status)
     * @param String $shop_id 店铺ID
     * @param Int $offset 页码
     * @param Int $limit 每页条数
     * @return Array $items
     **/
    public function items_all_get($filter,$shop_id,$offset=0,$limit=100)
    {
        $timeout    = 20;

        if(!$shop_id) return false;
        
        $result    = false;

        if ($result === false) {
            $this->set_err_msg('请求失败!');
            return false;
        } elseif ($result->rsp !== 'succ'){
            $this->set_err_msg('请求失败：'.$result->err_msg . '('. $result->msg_id .')');
            return false;
        }

        return json_decode($result->data, true);
    }

    /**
     * [分销]实时下载店铺商品
     *
     * @param Array $filter 筛选条件(approve_status)
     * @param String $shop_id 店铺ID
     * @param Int $offset 页码
     * @param Int $limit 每页条数
     * @return Array $items
     **/
    public function fenxiao_products_get($filter, $shop_id, $offset=0, $limit=100)
    {
        $timeout = 20;

        if(!$shop_id) return false;

        $result    = false;

        if ($result === false) {
            $this->set_err_msg('请求失败!');
            return false;
        } elseif ($result->rsp !== 'succ'){
            $this->set_err_msg('请求失败：'.$result->err_msg . '('. $result->msg_id .')');
            return false;
        }

        return json_decode($result->data,true);
    }

    /**
     * 根据IID，实时下载店铺商品
     *
     * @param Array $iids 商品ID(不要超过限度20个)
     * @param String $shop_id 店铺ID
     * @param Int $offset 页码
     * @param Int $limit 每页条数
     * @return Array
     **/
    public function items_list_get($iids,$shop_id)
    {
        if(!$iids || !$shop_id) return false;
        
        $result = false;
        
        if($result === false){
            $this->set_err_msg('请求失败!');
            return false;
        }elseif ($result->rsp !== 'succ') {
            $this->set_err_msg('请求失败：'.$result->err_msg . '('. $result->msg_id .')');
            return false;
        }
        
        return json_decode($result->data,true);
    }
}