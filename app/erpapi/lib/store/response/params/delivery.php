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

/**
 * 门店发货单响应参数定义类
 *
 * @author xiayuanjun@shopex.cn
 * @version 0.1
 *
 */
class erpapi_store_response_params_delivery extends erpapi_store_response_params_abstract
{
    /**
     * 发货单更新校验参数
     * status: confirm(发货单确认)、sign(签收)
     *
     * @return void
     * @author 
     **/
    public function status_update()
    {
        $params = array(
            'delivery_bn' => array('required'=>'true', 'type'=>'string','errmsg'=>'发货单号必填'),
            'status'=>array('type'=>'enum','value'=>array('delivery','print','check','cancel','update','accept','pick','package','partin','confirm','sign',
                'refuse')),
        );
        return $params;
    }

}