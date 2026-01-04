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

class openapi_data_original_store
{
    /**
     * 获取List
     * @param mixed $filter filter
     * @param mixed $offset offset
     * @param mixed $limit limit
     * @return mixed 返回结果
     */
    public function getList($filter, $offset = 0, $limit = 100)
    {
        $storeMdl = app::get('o2o')->model('store');

        $count = $storeMdl->count($filter);

        $rows = $storeMdl->getList('*', $filter, $offset, $limit);

        $lists = [];

        foreach ($rows as $row) {
            $area = $row['area'];
            kernel::single('eccommon_regions')->split_area($area);

            $store = [
                'store_bn'       => $row['store_bn'],
                'name'           => $row['name'],
             
                'open_hours'     => $row['open_hours'],
                'addr'           => $row['addr'],
                'zip'            => $row['zip'],
                'contacter'      => $row['contacter'],
                'mobile'         => $row['mobile'],
                'tel'            => $row['tel'],
                'status'         => $row['status'],
                'store_mode'     => $row['store_mode'],
                'store_sort'     => $row['store_sort'],
           
                'province'       => $area[0],
                'city'           => $area[1],
                'district'       => $area[2],
            ];

            $lists[] = $store;
        }

        return [
            'lists' => $lists,
            'count' => $count,
        ];
    }
}
