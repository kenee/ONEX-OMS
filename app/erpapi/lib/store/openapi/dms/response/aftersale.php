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

class erpapi_store_openapi_dms_response_aftersale extends erpapi_store_response_aftersale
{
    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function add($params)
    {
        $sdf = parent::add($params);

        // 退货仓
        $flow = app::get('o2o')->model('branch_flow')->dump([
            'to_store_bn' => $params['store_bn'],
        ]);
        if (!$flow) {
            $this->__apilog['result']['msg'] = sprintf('[%s]未匹配退货仓', $params['store_bn']);
            return false;
        }

        $channel = app::get('o2o')->model('channel')->dump($flow['channel_id']);
        if (!$channel['reship_branch_id']) {
            $this->__apilog['result']['msg'] = sprintf('[%s]未匹配退货仓', $params['store_bn']);
            return false;
        }

        $sdf['warehouse_code'] = $channel['reship_branch_bn'];
        $sdf['status']         = 'APPLY';

        return $sdf;
    }
}
