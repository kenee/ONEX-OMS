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

class openapi_data_original_workorder {

    /**
     * 获取List
     * @param mixed $filter filter
     * @param mixed $page_no page_no
     * @param mixed $limit limit
     * @return mixed 返回结果
     */
    public function getList($filter, $page_no, $limit)
    {
        $return = ['lists'=>[], 'count'=>0];
        $model = app::get('console')->model('material_package');
        $count = $model->count($filter);
        if($count < 1) {
            return $return;
        }
        $return['count'] = $count;
        $rows = $model->getList('*', $filter, ($page_no-1)*$limit, $limit);
        $branch = app::get('ome')->model('branch')->getList('branch_id, branch_bn, name', ['branch_id'=>array_unique(array_column($rows, 'branch_id'))]);
        $branch = array_column($branch, null, 'branch_id');
        $items = $this->_getItems($rows);
        $itemDetail = $this->_getItemDetail($rows);
        foreach($rows as $row) {
            $tmp = [];
            $tmp['mp_bn'] = $row['mp_bn'];
            $tmp['branch_bn'] = $branch[$row['branch_id']]['branch_bn'];
            $tmp['branch_name'] = $branch[$row['branch_id']]['name'];
            $tmp['status'] = $row['status'];
            $tmp['service_type'] = $row['service_type'];
            $tmp['memo'] = $row['memo'];
            $tmp['complete_time'] = $row['complete_time'];
            $tmp['at_time'] = $row['at_time'];
            $tmp['up_time'] = $row['up_time'];
            if($items[$row['id']]) {
                foreach($items[$row['id']] as $item) {
                    $tmpItem = [
                        'material_bn' => $item['bm_bn'],
                        'material_name' => $item['bm_name'],
                        'quantity' => $item['number'],
                    ];
                    if($itemDetail[$item['id']]) {
                        foreach($itemDetail[$item['id']] as $detail) {
                            $tmpItem['sub_items'][] = [
                                'material_bn' => $detail['bm_bn'],
                                'material_name' => $detail['bm_name'],
                                'quantity' => $detail['number'],
                            ];
                        }
                    }
                    $tmp['items'][] = $tmpItem;

                }
            }
            $return['lists'][] = $tmp;
        }
        return $return;
    }

    private function _getItems($rows)
    {
        $items = [];
        $mpItems = app::get('console')->model('material_package_items')->getList('*', ['mp_id'=>array_column($rows, 'id')]);
        foreach($mpItems as $item) {
            $items[$item['mp_id']][] = $item;
        }
        return $items;
    }

    private function _getItemDetail($rows)
    {
        $itemDetail = [];
        $mpdItems = app::get('console')->model('material_package_items_detail')->getList('*', ['mp_id'=>array_column($rows, 'id')]);
        foreach($mpdItems as $item) {
            $itemDetail[$item['mpi_id']][] = $item;
        }
        return $itemDetail;
    }
}