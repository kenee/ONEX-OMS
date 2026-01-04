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
* @author ykm 2015-12-25
* @describe member打印数据整理
*/
class logisticsmanager_print_data_member{
    private $mField = array(
        'member_id',
    );

    /**
     * member
     * @param mixed $oriData ID
     * @param mixed $corp corp
     * @param mixed $field field
     * @param mixed $type type
     * @return mixed 返回值
     */

    public function member(&$oriData, $corp, $field, $type) {
        $pre = __FUNCTION__ . '.';
        $memberIds = array();
        foreach($oriData as $k => $val) {
            $memberIds[] = $val['member_id'];
        }
        $memberModel = app::get('ome')->model('members');
        $strField = kernel::single('logisticsmanager_print_data')->getSelectField($this->mField, $field, $memberModel);
        $member = $memberModel->getList($strField, array('member_id'=>array_unique($memberIds)));
        $memberData = array();
        foreach($member as $row) {
            $memberData[$row['member_id']] = $row;
        }
        foreach($oriData as $key => $value) {
            foreach($field as $f) {
                if(isset($memberData[$value['member_id']][$f])) {
                    $oriData[$key][$pre . $f] = $memberData[$value['member_id']][$f];
                } elseif(method_exists($this, $f)) {
                    $oriData[$key][$pre . $f] = $this->$f($memberData[$value['member_id']]);
                } else {
                    $oriData[$key][$pre . $f] = '';
                }
            }
        }
    }
}