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
 * @author ykm 2018/3/20
 * @describe 绑定相关
 */
class erpapi_bind_config extends erpapi_config
{

    /**
     * 获取_query_params
     * @param mixed $method method
     * @param mixed $params 参数
     * @return mixed 返回结果
     */

    public function get_query_params($method, $params){
        return array();
    }

    /**
     * 获取_url
     * @param mixed $method method
     * @param mixed $params 参数
     * @param mixed $realtime realtime
     * @return mixed 返回结果
     */
    public function get_url($method, $params, $realtime){
        $url = rtrim(MATRIX_RELATION_URL, '/').'/api.php'; #矩阵
        return $url;
    }

    /**
     * gen_sign
     * @param mixed $params 参数
     * @param mixed $method method
     * @return mixed 返回值
     */
    public function gen_sign($params,$method=''){
        return null;
    }
}