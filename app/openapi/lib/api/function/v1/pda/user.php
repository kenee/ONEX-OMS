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
 * @author ykm 2017/1/13
 * @describe PDA用户信息
 */
class openapi_api_function_v1_pda_user extends openapi_api_function_v1_pda_abstract {
    //用户信息确认
    /**
     * confirm
     * @param mixed $params 参数
     * @param mixed $code code
     * @param mixed $sub_msg sub_msg
     * @return mixed 返回值
     */

    public function confirm($params,&$code,&$sub_msg){
        if(empty($params['device_code']) || !$this->check_device_code($params['device_code'])){
            $sub_msg = '设备未授权';
            return false;
        }
        $userName = trim($params['user_name']);
        $password = trim($params['password']);
        $accountType = pam_account::get_account_type('desktop');
        $passwordString = pam_encrypt::get_encrypted_password($password, $accountType);
        $user = app::get('pam')->model('account')->db_dump(array(
            'login_name'=>$userName,
            'login_password'=>$passwordString,
            'account_type' => $accountType,
            'disabled' => 'false',
        ), '*');
        if($user) {
            $objSession = kernel::single('base_session');
            $objSession->start();
            $_SESSION = array (
                'login_time' => time(),
                'account' =>
                    array (
                        $accountType => $user['account_id'],
                    ),
                'type' => $accountType,
            );
            $sessionId = $objSession->sess_id();
            return array('pda_token'=>$sessionId);
        } else {
            $sub_msg = '用户名或密码错误';
            return false;
        }
    }

    /**
     * cancel
     * @param mixed $params 参数
     * @param mixed $code code
     * @param mixed $sub_msg sub_msg
     * @return mixed 返回值
     */
    public function cancel($params, &$code, &$sub_msg) {
        $pdaToken = $params['pda_token'];
        if(empty($pdaToken)) {
            $sub_msg = '缺少pda_token';
            return false;
        }
        if(empty($params['device_code']) || !$this->check_device_code($params['device_code'])){
            $sub_msg = '设备未授权';
            return false;
        }
        $_COOKIE[SESS_NAME] = $pdaToken;
        $objSession = kernel::single('base_session');
        $objSession->start();
        if(empty($_SESSION)) {
            return array('pda_token'=>$pdaToken, 'msg'=>'已经退出成功了');
        }
        if($objSession->destory()) {
            return array('pda_token'=>$pdaToken, 'msg'=>'退出成功');
        } else {
            $sub_msg = '退出失败';
            return false;
        }
    }

}