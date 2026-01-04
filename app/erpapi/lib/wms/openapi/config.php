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
 * CONFIG
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_openapi_config extends erpapi_wms_config
{
    /**
     * 应用级参数
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @return void
     * @author 
     **/
    public function get_query_params($method, $params){
        $query_params = array(
            'v'            => '1.0',
            'method'       => $method,
            'format'       => 'json',
            'timestamp'    => time(),
            'wms_node_id'  => $this->__channelObj->wms['node_id'],
            'from_node_id' => base_shopnode::node_id('ome'),
        );

        return $query_params;
    }

    public function gen_sign($params){
        $private_key = $this->__channelObj->wms['adapter']['config']['private_key'];

        return strtoupper(md5(strtoupper(md5(self::assemble($params))).$private_key));
    }

    public function get_url($method, $params, $realtime){
        $url = $this->__channelObj->wms['adapter']['config']['api_url'];

        return $url;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    final public function get_openapi_list()
    {
        $config = array();

        $path = APP_DIR.'/erpapi/lib/wms/openapi/';

        $handler = opendir($path);

        do {
            $dir = readdir($handler);
            if (!$dir) break;

            if (!is_dir($path.$dir) || in_array($dir,array('.','..','.svn'))) continue;

            $object_name = "erpapi_wms_openapi_{$dir}_config";

            try {
                if (!class_exists($object_name)) continue;

                $object = kernel::single($object_name);

                $config[$dir] = $object->define_query_params();

            } catch (Exception $e) {
                // do nothing
            }

        } while (true);

        closedir($handler);

        return $config;
    }
}