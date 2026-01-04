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
 * @Author: xueding@shopex.cn
 * @Date: 2024/12/4
 * @Describe: 获取拼多多平台基础信息
 */
class erpapi_shop_matrix_pinduoduo_request_base extends erpapi_shop_request_base
{
    /**
     * 获取拼多多 page code 信息
     *
     * @param $params
     * @return array
     */
    public function getPageCode($params = [])
    {
        $title       = $this->__channelObj->channel['name'] . '获取检测页面code获取';
        $original_bn = 'pinduoduo_get_page_code';

        $params['httpReferer'] = 'client';
        $params['userId']      = base_enterprise::ent_id();

        $result = $this->__caller->call(SHOP_ISV_PAGE_CODE, $params, [], $title, 10, $original_bn);

        // $result = json_decode($result, 1);
        if ($result['data']) {
            $result['data'] = json_decode($result['data'], true);
        }
        return $result;
    }
}
