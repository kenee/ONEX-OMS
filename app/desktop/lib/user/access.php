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

class desktop_user_access
{
    /**
     * 仓储权限标记
     * @var int
     */
    const __BRANCH_ROLE = 2;

    /**
     * 订单分组权限标记
     * @var int
     */
    const __ORDER_ROLE = 3;

    /**
     * 门店权限标记
     * @var int
     */
    const __STORE_ROLE = 99;

    /**
     * 仓库权限
     *
     * @return void
     * @author
     **/
    public function role($role = null, $check_id = [], $user_id = null, $post = [])
    {
        $roles = app::get('desktop')->model('roles');
        $menus = app::get('desktop')->model('menus');

        if (!$check_id) {
            return '';
        }

        $aPermission = array();
        foreach ($roles->getList('*', ['role_id' => $check_id]) as $val) {
            $data = unserialize($val['workground']);
            if ($data) {
                $aPermission = array_merge($aPermission, $data);
            }
        }

        $aPermission = array_unique($aPermission);

        if (!$aPermission) {
            return '';
        }

        $branchList = [];

        $menuList = $menus->getList('*', array('menu_type' => 'permission', 'permission' => $aPermission));
        foreach ($menuList as $key => $value) {
            $addon = unserialize($value['addon']);

            if (!$addon) {
                continue;
            }

            if ($addon['show'] && $addon['save']) {
                // 如果存在控制

                $access    = explode(':', $addon['show']);
                $classname = $access[0];
                $method    = $access[1];
                $obj       = kernel::single($classname);

                // 检测是否包含订单确认
                if ('show_group' == $method && $role == self::__ORDER_ROLE) {
                    return $obj->$method($user_id,$post);
                }

                //检测是否包含仓库选择
                if ('show_branch' == $method && $role == self::__BRANCH_ROLE) {
                    return $branchList = $obj->$method($user_id, $post);
                }

                //检测是否包含仓库选择
                if ('show_o2o_branch' == $method && $role == self::__STORE_ROLE) {
                    return $obj->$method($user_id, $post);
                }
            }
        }
    }
}
