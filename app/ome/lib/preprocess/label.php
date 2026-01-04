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
 * 订单打标签
 *
 * @author wangbiao@shopex.cn
 * @version $Id: Z
 */
class ome_preprocess_label
{
    /**
     * 执行打标签
     * 
     * @param int $order_id
     * @param string $msg
     * @return boolean
     */
    public function process($order_id, &$msg=null)
    {
        if(empty($order_id)){
            $msg = '打标签缺少处理参数';
            return false;
        }
        
        //打标签
        $labelLib = kernel::single('omeauto_order_label');
        $result = $labelLib->makeOrderLabel($order_id, $msg);
        if(!$result){
            $msg = '订单打标记失败：'. $msg;
            return false;
        }
        
        return true;
    }
}