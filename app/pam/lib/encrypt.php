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

class pam_encrypt{
    /**
     * 获取加密后的密码
     * @param string $password 原始密码
     * @param string $account_type 账户类型
     * @param int|null $is_hash256 是否使用SHA256加密（1=是，0=否），默认为1（新加密方式）
     * @return string 加密后的密码
     */
    public static function get_encrypted_password($password, $account_type, $is_hash256 = null){
        // 如果没有传入 is_hash256，默认使用新加密方式（1）
        if ($is_hash256 === null) {
            $is_hash256 = 1;
        } else {
            $is_hash256 = intval($is_hash256);
        }

        $encrypt = kernel::service('encrypt_'.$account_type);
        if(is_object($encrypt)){
            if(method_exists($encrypt,'get_encrypted')){
                return $encrypt->get_encrypted($password, $is_hash256);
            }
        }else{
            $encrypt = kernel::single('pam_encrypt_default');
        }
        return $encrypt->get_encrypted($password, $is_hash256);
    }
}