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
 * @describe pda 获取异常原因
 * @author pangxp
 */
class openapi_data_original_pda_abnormalcause{

    /**
     * 获取List
     * @param mixed $filter filter
     * @param mixed $offset offset
     * @param mixed $limit limit
     * @return mixed 返回结果
     */

    public function getList($filter, $offset = 0, $limit = 100){
        $abnormal_cause = app::get('wms')->model('abnormal_cause');
        $count = $abnormal_cause->count($filter);
        $data = $abnormal_cause->getList('*', $filter, $offset, $limit);
        return array(
        	'state' => 0, // 0成功 1失败  pda那边提供的接口约定  尽量以他们的为准了
            'lists' => $data,
            'count' => $count,
        );
    }

}