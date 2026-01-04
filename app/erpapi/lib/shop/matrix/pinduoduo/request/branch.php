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

class erpapi_shop_matrix_pinduoduo_request_branch extends erpapi_shop_request_branch {

    protected function _formatProvinceData($data) {
        $return = [];
        if (is_array($data) && is_array($data['data'])) {
            foreach($data['data'] as $v) {
                $return[] = [
                    'province_id' => $v['id'],
                    'province' => $v['region_name'],
                ];
            }
        }
        return $return;
    }

    protected $areaOutregionId = 'id';
    protected $areaOutregionName = 'region_name';
    protected $areaOutparentId = 'parent_id';
    protected function _formatAreasByProvince($data) {
        return $data['data'] ? [$data['data']]: [];
    }
}