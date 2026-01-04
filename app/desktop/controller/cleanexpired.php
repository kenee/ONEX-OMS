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

class desktop_ctl_cleanexpired extends desktop_controller{
    var $certcheck = false;

    function index(){
        $this->page('cleanexpired.html');
    }

    function clean_data(){
        //清楚中心绑定相关信息
        kernel::single('base_cleandata')->clean();

        //退出登录
        $this->begin('javascript:Cookie.dispose("basicloginform_password");Cookie.dispose("basicloginform_autologin");top.location="'.kernel::router()->app->base_url(1).'"');
        $this->user->login();
        $this->user->logout();
        $auth = pam_auth::instance(pam_account::get_account_type($this->app->app_id));
        foreach(kernel::servicelist('passport') as $k=>$passport){
            if($auth->is_module_valid($k,$this->app->app_id))
                $passport->loginout($auth,$backurl);
        }
        kernel::single('base_session')->destory();
        $this->end('true',app::get('desktop')->_('已成功退出系统,正在转向...'));
    }
}
