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
 *  前后端分离，管理员类
 *
 * @author <chenping@shopex.cn>
 * @time 2020-11-18T19:26:39+08:00
 */
class erpapi_front_response_user extends erpapi_front_response_abstract
{
    /**
     * 管理员登陆，method=front.user.login
     *
     * @param array $params (uname="test" password="test")
     * @return array (uname="test" password="test")
     * @author
     **/

    public function login($params)
    {
        $this->__apilog['title']       = '管理员登陆';
        $this->__apilog['original_bn'] = $params['uname'];

        if (!$params['uname']) {
            $this->__apilog['result']['msg'] = '缺少用户名';
            return false;
        }

        if (!$params['password']) {
            $this->__apilog['result']['msg'] = '缺少用户密码';
            return false;
        }

        $params['uname']    = trim($params['uname']);
        $params['password'] = trim($params['password']);

        return $params;
    }

    /**
     * 用户登出，method=front.user.logout
     * 需要SESSION授权
     *
     * @param array $params
     * @return void
     * @author
     **/
    public function logout($params)
    {
        return $params;
    }
}
