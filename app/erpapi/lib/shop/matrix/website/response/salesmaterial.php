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
 * @desc
 * @author:
 * @since:
 */
class erpapi_shop_matrix_website_response_salesmaterial extends erpapi_shop_response_salesmaterial {

    /**
     * 获取list
     * @param mixed $params 参数
     * @return mixed 返回结果
     */

    public function getlist($params)
    {

        $params = array_filter($params);
        $filter = array();

        $start_time = $params['start_time'] ? strtotime($params['start_time']) : 0;
        $end_time = $params['end_time'] ? strtotime($params['end_time']) : time();

        $filter = array(
            'last_modify|bthan' => $start_time,
            'last_modify|sthan' => $end_time,
        );

        if (isset($params['shop_bn'])) {
            $shopModel = app::get('ome')->model('shop');
            $shopInfo = $shopModel->dump(array('shop_bn' => $params['shop_bn']), 'shop_id');
            if (empty($shopInfo)) {
                $this->__apilog['result']['msg'] = '销售物料归属渠道不存在';
                return false;
            }
            $filter['shop_id'] = $params['shop_id'];
        }

        if (isset($params['sales_material_bn'])) {
            $filter['sales_material_bn'] = explode(',', $params['sales_material_bn']);
        }

        $filter['page_no'] = intval($params['page_no']) > 0 ? intval($params['page_no']) : 1;
        $filter['page_size'] = (intval($params['page_size']) > 100 || intval($params['page_size']) <= 0) ? 100 : intval($params['page_size']);

        return $filter;
    }
}
