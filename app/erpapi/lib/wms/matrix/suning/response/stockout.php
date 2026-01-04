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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2020/6/11 14:41:31
 * @describe: 类
 * ============================
 */
class erpapi_wms_matrix_suning_response_stockout extends erpapi_wms_response_stockout
{
    /**
     * status_update
     * @param mixed $params 参数
     * @return mixed 返回值
     */

    public function status_update($params)
    {
        $items = isset($params['item']) ? json_decode($params['item'], true) : array();

        foreach ($items as $key => $value) {
            $items[$key]['num'] = $value['normal_num'];
        }

        $params['item'] = json_encode($items);

        return parent::status_update($params);
    }
}
