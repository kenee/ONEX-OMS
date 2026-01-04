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

class ome_order_refund_status_api extends ome_order_refund_status_abstract {

    /**
     * fetch
     * @param mixed $tid ID
     * @param mixed $nodeId ID
     * @param mixed $shopId ID
     * @return mixed 返回值
     */
    public function fetch($tid, $nodeId, $shopId){
        $rs = kernel::single('erpapi_router_request')->set('shop',$shopId)->finance_getNotifyOid(['order_bn'=>$tid]);
        if($rs['rsp'] == 'fail') {
            return [false, ['msg'=>'接口失败：'.$rs['msg']]];
        }
        return [true, ['data'=>$rs['data']]];
    }

    /**
     * store
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function store($sdf) {
        return [false, ['msg'=>'接口方式，无法写入数据']];
    }
}