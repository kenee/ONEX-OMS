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


class ome_rpc_response_version_2_refund extends ome_rpc_response_version_base_refund
{

    /**
     * 添加退款单
     * @access public
     * @param array $refund_sdf 退款单数据
     * @return array 退款单主键ID array('refund_id'=>'退款单主键ID')
     */
    function add($refund_sdf){
        $rs = parent::add($refund_sdf);
        return $rs;
    }

    /**
     * 更新退款单状态
     * @access public
     * @param array $status_sdf 退款单状态数据
     */
    function status_update($status_sdf){
        $rs = parent::status_update($status_sdf);
        return $rs;
    }
}