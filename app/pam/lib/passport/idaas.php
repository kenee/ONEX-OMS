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


class pam_passport_idaas implements pam_interface_passport
{
    /**
     * 任务登陆标识
     * 
     * @var string
     * */
    public $loginType = 'IDAAS';
    
    /**
     * undocumented function
     * 
     * @return void
     * @author
     * */
    public function __construct()
    {
    
    }
    
    public function get_name()
    {
        return 'Idaas Account Sign In';
    }
    
    public function get_login_form($auth, $appid, $view, $ext_pagedata = array())
    {
        return;
    }
    
    public function login($auth, &$usrdata)
    {
    
    }
    
    public function callback() {

        $_GOTO = kernel::base_url(1).'/index.php?ctl=passport';
        
        $fid              = $_POST['fid'];
        $username         = $_POST['username'];
        $mobileverifycode = $_POST['mobileverifycode'];
        $phoneNumber      = $_POST['phoneNumber'];
        
        
        if ($mobileverifycode) {
            $params = [
                'login_name'       => $username,
                'mobileverifycode' => $mobileverifycode,
                'fid'              => $fid,
            ];
            $res = kernel::single('erpapi_router_request')
                         ->set('idaas', 'aliyun')
                         ->account_checkMobileVerifyCode($params);
            
            if ($res['rsp'] == 'succ') {
                kernel::single('base_session')->start();
                base_kvstore::instance('idaas')->fetch($fid, $_SESSION);
                header('Location:' . kernel::get_host_url());exit;
            }
            
            if ($res['rsp'] != 'succ') {
                $errorMsg = $res['err_msg'].'，<a class="c-blue lnk" href="'.$_GOTO.'">重新登陆</a>';
            }
        } else {
            $errorMsg = '无效验证码'.'，<a class="c-blue lnk" href="'.$_GOTO.'">重新登陆</a>';
        }
        
        $render = kernel::single('base_render');

        $render->pagedata['fid']         = $fid;
        $render->pagedata['username']    = $username;
        $render->pagedata['phoneNumber'] = $phoneNumber;
        $render->pagedata['err_msg']     = $errorMsg;
        $render->display('login_second_factor.html', 'desktop');

    }
    
        /**
     * loginout
     * @param mixed $auth auth
     * @param mixed $backurl backurl
     * @return mixed 返回值
     */
    public function loginout($auth, $backurl = "index.php")
    {
    }
    
    /**
     * 获取_data
     * @return mixed 返回结果
     */
    public function get_data()
    {
    }
    
    /**
     * 获取_id
     * @return mixed 返回结果
     */
    public function get_id()
    {
    }
    
    /**
     * 获取_expired
     * @return mixed 返回结果
     */
    public function get_expired()
    {
    }
    
    /**
     * 获取_config
     * @return mixed 返回结果
     */
    public function get_config()
    {
    }
    
}
