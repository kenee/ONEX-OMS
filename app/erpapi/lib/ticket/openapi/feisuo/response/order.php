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

class erpapi_ticket_openapi_feisuo_response_order extends erpapi_ticket_response_order
{    

    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function add($params)
    {

        $this->__apilog['title']       = $this->__channelObj->channel['channel_name'].'补发单创建';
        $this->__apilog['original_bn'] = $params['tid'];
 
        $this->__apilog['result']['msg'] = '暂未实现';

        return false;
    }
}
