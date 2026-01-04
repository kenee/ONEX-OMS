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


class ome_service_order_edit_goods{
    
    /**
     * 获取goods的显示定义
     * @access public
     */
    public function get_view(){
        return kernel::single("ome_order_edit_goods")->get_config();
    }
    
    /**
     * 处理订单编辑时提交的数据
     * @access public
     * @param array $data 订单编辑的数据
     */
    public function process($data){
        return kernel::single("ome_order_edit_goods")->process($data);
    }
    /**
     * 判断这次提交的数据在处理完成后，是否还存在有正常的数据。
     * @param array $data 订单编辑的数据  //POST
     */
    public function is_null($data){
        return kernel::single("ome_order_edit_goods")->is_null($data);
    }
    
    /**
     * 校验订单编辑时提交的数据
     * @param array $data 订单编辑的数据  //POST
     */
    public function valid($data){
        return kernel::single("ome_order_edit_goods")->valid($data);
    }
    
    /**
     * 判断订单上商品明细是否被修改
     *
     * @param array $data 订单编辑的数据
     * @return bool
     */
    public function is_edit_product($data){
        return kernel::single("ome_order_edit_goods")->is_edit_product($data);
    }
}