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
 * 自建WAP移动端响应类
 *
 * @author xiayuanjun@shopex.cn
 * @version 0.1
 *
 */
class erpapi_store_wap_response_delivery  extends erpapi_store_response_delivery 
{
    /**
     * status_update
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function status_update($params){
        $this->__apilog['title']       = $this->__channelObj->wms['channel_name'].'发货单更新('.$params['status'].')';
        $this->__apilog['original_bn'] = $params['delivery_bn'];

        return $params;
    }
}
