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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2022/11/29 11:21:30
 * @describe: 加工单
 * ============================
 */
class erpapi_wms_response_params_storeprocess extends erpapi_wms_response_params_abstract
{
    
    /**
     * status_update
     * @return mixed 返回值
     */

    public function status_update()
    {
        $params = array(
            'mp_bn' => array('required'=>'true','type'=>'string','errmsg'=> '加工单号必填'),
            'material_items' => array('required'=>'true','type'=>'array','errmsg'=> '缺少materialitems'),
            'product_items' => array('required'=>'true','type'=>'array','errmsg'=> '缺少productitems'),
        );

        return $params;
    }
}