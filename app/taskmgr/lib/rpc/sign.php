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

//加载配置信息
require_once(dirname(__FILE__) . '/../../config/config.php');
class taskmgr_rpc_sign{

    /**
     *
     * 生成签名算法函数
     * @param array $params
     */
    static public function gen_sign($params){
        return strtoupper(md5(strtoupper(md5(self::assemble($params))).REQ_TOKEN));
    }

	/**
     *
     * 签名参数组合函数
     * @param array $params
     */
    static private function assemble($params)
    {
        if(!is_array($params))  return null;
        ksort($params, SORT_STRING);
        $sign = '';
        foreach($params AS $key=>$val){
            if(is_null($val))   continue;
            if(is_bool($val))   $val = ($val) ? 1 : 0;
            $sign .= $key . (is_array($val) ? self::assemble($val) : $val);
        }
        return $sign;
    }
}