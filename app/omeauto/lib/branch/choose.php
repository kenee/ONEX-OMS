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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2020/9/8 16:51:42
 * @describe: 仓库选择
 * ============================
 */
class omeauto_branch_choose {

    /**
     * cmp_router_weight
     * @param mixed $a a
     * @param mixed $b b
     * @return mixed 返回值
     */

    public function cmp_router_weight($a, $b) {
        if($a['weight'] === $b['weight']) {
            return 0;
        }
        return $a['weight'] > $b['weight'] ? -1 : 1;
    }

    public function getSelectBid($tid,&$group,$branchInfo = array()) {
        $branchIds = $group->getBranchId();
        if(empty($branchIds)) {
            return 0;
        }
        if(count($branchIds) == 1) {
            return current($branchIds);
        }
        if(empty($tid)) {
            return reset($branchIds);
        }
        $objBranchGet = app::get('omeauto')->model('autobranchget');
        $bg = $objBranchGet->getList('*', array('tid'=>$tid));
        if(empty($bg)) {
            return reset($branchIds);
        }
        uasort($bg, array($this, 'cmp_router_weight'));
        foreach ($bg as $v) {
            $bgData = $group->getBranchGroup();
            if(count($bgData) == 1) {
                $bgRowData = current($bgData);
                return reset($bgRowData['branch_id']);
            }
            try {
                $className = 'omeauto_branch_' . $v['classify'];
                if(class_exists($className)) {
                    $branchIds = kernel::single($className)->process($branchIds, $group, $branchInfo);
                    if(count($branchIds) == 1) {
                        return current($branchIds);
                    }
                }
            } catch (Exception $e){}
        }
        return reset($branchIds);
    }
}