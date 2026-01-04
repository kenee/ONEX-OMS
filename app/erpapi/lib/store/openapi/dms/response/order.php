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

class erpapi_store_openapi_dms_response_order extends erpapi_store_response_order
{
    /**
     * 创建订单
     *
     * @return void
     * @author
     **/
    public function add($params)
    {
        $sdf = parent::add($params);

        if ($sdf == false) {
            return false;
        }

        // 判断是否传了movement code
        if (!$params['movement_code'] || !is_numeric($params['movement_code'])) {
            $this->__apilog['result']['msg'] = "缺少movement code";
            return false;
        }
        $sdf['movement_code'] = $params['movement_code'];

        $sdf['is_try'] = 'true';

        // 获取渠道发货仓
        $flow = app::get('o2o')->model('branch_flow')->dump([
            'to_store_bn' => $params['store_bn'],
        ]);
        if (!$flow) {
            $this->__apilog['result']['msg'] = sprintf('[%s]未匹配发货仓', $params['store_bn']);
            return false;
        }

        $channel = app::get('o2o')->model('channel')->dump($flow['channel_id']);
        if (!$channel['branch_id']) {
            $this->__apilog['result']['msg'] = sprintf('[%s]未匹配发货仓', $params['store_bn']);
            return false;
        }

        foreach ($sdf['order_objects'] as $key => $value) {
            $sdf['order_objects'][$key]['store_code'] = $channel['branch_bn'];
        }

        return $sdf;
    }
}
