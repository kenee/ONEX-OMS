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


class taoexlib_desktop_validity {
    
    /**
     * function_menu
     * @return mixed 返回值
     */
    public function function_menu() {
        //新增desktop_menu显示短信部分-2016-12-16
        base_kvstore::instance('taoexlib')->fetch('account', $account);
        if(!defined('APP_TOKEN') || !defined('APP_SOURCE') || !$account){
            $desktop_menu = "<a href='index.php?app=taoexlib&ctl=admin_account&act=index'>".app::get('desktop')->_('短信剩余(')."<font color='red'>".app::get('desktop')->_('未开通')."</font>".")</a>";
        }else{
            $key = 'sms_user_info_num';
            $sms_info = cachecore::fetch($key);
            if(!$sms_info) {
                $sms_info = kernel::single('erpapi_router_request')->set('sms', $account)->sms_getUserInfo();
                cachecore::store($key, $sms_info, 300);
            }
            if('succ' == $sms_info['rsp']){
                $desktop_menu = "<a href='index.php?app=taoexlib&ctl=admin_account&act=index'>".app::get('desktop')->_('短信剩余(')."<font color='red'>".app::get('desktop')->_($sms_info['data']['month_residual'])."</font>"."条)</a>";
            }else{
                $desktop_menu = "<a href='index.php?app=taoexlib&ctl=admin_account&act=index'>".app::get('desktop')->_('短信剩余(')."<font color='red'>".app::get('desktop')->_('未开通')."</font>".")</a>";
            }
        }
        return $desktop_menu;
    }
    
}