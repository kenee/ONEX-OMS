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
 *
 * @author ykm 2015-12-23
 * @describe 仓库相关数据
 */
class logisticsmanager_print_data_branch {
    private $mField = array(
        'area',
    );

    /**
     * branch
     * @param mixed $oriData ID
     * @param mixed $corp corp
     * @param mixed $field field
     * @param mixed $type type
     * @return mixed 返回值
     */

    public function branch(&$oriData, $corp, $field, $type) {
        $pre = __FUNCTION__ . '.';

        $branch_id = array('0');
        foreach($oriData as $k => $val) {
            $branch_id[$val['branch_id']] = $val['branch_id'];
        }

        $branchList = array();
        $branchMdl = app::get('ome')->model('branch');
        foreach ($branchMdl->getList('branch_id,area,uname,address,phone,mobile',array('branch_id'=>$branch_id,'skip_permission'=>true)) as $value) {
            $branchList[$value['branch_id']] = $value;
        }

        foreach ($oriData as $key => $value) {
            $branch = $branchList[$value['branch_id']];

            foreach ($field as $f) {
                if (isset($branch[$f])) {
                    $oriData[$key][$pre . $f] = (string)$branch[$f];
                } elseif (method_exists($this, $f)) {
                    $oriData[$key][$pre . $f] = (string)$this->$f($branch);
                } else {
                    $oriData[$key][$pre . $f] = '';
                }
            }
        }
    }

    private function area_0($row) {
        $area = $this->getArea($row);
        return $area[0];
    }

    private function area_1($row) {
        $area = $this->getArea($row);
        return $area[1];
    }

    private function area_2($row) {
        $area = $this->getArea($row);
        return $area[2];
    }

    private function detailaddr($row)
    {
        list(,$area) = explode(':', $row['area']);

        return str_replace('/','',$area).$row['address'];
    }

    private function getArea($row) {
        static $area = array();

        if(!$area[$row['area']]) {
            list(,$a) = explode(':', $row['area']);
            $area[$row['area']] = explode('/',$a);
        }

        return $area[$row['area']];
    }
}