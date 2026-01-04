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


class finance_rpc_response_func_bill{

    /**
     * 批量添加交易数据
     * @access public
     * @param String $record_list 交易数据
     * @param String $node_id 节点ID
     * @return Array
     */
    function batch_trade_add($record_list,$node_id=''){
        $rs = array('rsp'=>'fail','msg'=>'');
        if (empty($record_list) || !isset($record_list[0])){
            $rs['msg'] = '交易数据不能为空或格式不正确';
            return $rs;
        }
        foreach ($record_list as $items){
            $rs = $this->trade_add($items,$node_id);
            if ($rs['rsp'] != 'succ'){
                break;
            }
        }
        return $rs;
    }

    /**
     * 单个添加交易数据
     * @access public
     * @param Array $record 单条交易数据
     * @param String $node_id 节点ID
     * @return Array
     */
    function trade_add($record,$node_id=''){
        $rs = array('rsp'=>'fail','msg'=>'');
        if (empty($record) || !isset($node_id)){
            $rs['msg'] = '交易数据或节点与不能为空';
            return $rs;
        }

        $shop_detail = kernel::single('finance_func')->getShopByNodeID($node_id);
        $node_type = $shop_detail['node_type'];
        $class_name = 'finance_rpc_response_func_bill'.$node_type;
        if (ome_func::class_exists($class_name) && $instance = kernel::single($class_name)){
            if (method_exists($instance,'trade_add')){
                $rs = $instance->trade_add($record,$shop_detail);
            }else{
                $rs['msg'] = 'method trade_add NOT FOUND';
            }
        }else{
            $rs['msg'] = 'class:'.$class_name.' NOT FOUND';
        }
        
        return $rs;
    }

}