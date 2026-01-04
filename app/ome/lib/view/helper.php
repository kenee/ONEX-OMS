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

class ome_view_helper{

    function __construct(&$app){
        $this->app = $app;
    }
    
    /**
     * function_desktop_header
     * @param mixed $params 参数
     * @param mixed $smarty smarty
     * @return mixed 返回值
     */
    public function function_desktop_header($params, &$smarty){
        return $smarty->fetch('admin/include/header.tpl',$this->app->app_id);
    }

    /**
     * function_desktop_footer
     * @param mixed $params 参数
     * @param mixed $smarty smarty
     * @return mixed 返回值
     */
    public function function_desktop_footer($params, &$smarty){
        $accountsafy = true;

        if ($_SESSION['needChangePassword'] && !$_SESSION['login_trust']){
            $accountsafy = false;
        }

        if (!kernel::single('desktop_user')->get_mobile() && !$_SESSION['login_trust']) {
            $accountsafy = false;
        }
        $smarty->pagedata['accountsafy'] = $accountsafy;

        return $smarty->fetch('admin/include/footer.tpl',$this->app->app_id);
    }

}
