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

class pam_encrypt_default{
    /**
     * 加密密码
     * @param string $source_str 原始密码
     * @param int $is_hash256 是否使用SHA256加密（1=是，0=否）
     * @return string 加密后的密码
     */
    public static function get_encrypted($source_str, $is_hash256 = 0){
        $md5_hash = md5($source_str);
        // 如果 is_hash256=1，在MD5基础上再进行SHA256加密
        if ($is_hash256 == 1) {
            return hash('sha256', $md5_hash);
        }
        // 否则只使用MD5加密（兼容旧密码）
        return $md5_hash;
    }
}