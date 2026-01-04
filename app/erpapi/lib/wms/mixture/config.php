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
 * CONFIG
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_mixture_config extends erpapi_wms_config
{
    /**
     * 获取请求地址
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @param Boolean $realtime 同步|异步
     * @return void
     * @author 
     **/

    public function get_url($method, $params, $realtime){
        $config = $this->__channelObj->wms['adapter']['config'];
        
        $url = $config['url'] ? $config['url'] : app::get('wmsmgr')->getConf('api_url'.$this->__channelObj->wms['node_id']);
        if (in_array($method,array(WMS_SALEORDER_CANCEL,WMS_INORDER_CANCEL,WMS_OUTORDER_CANCEL))){
            $url = parent::get_url($method, $params, $realtime);
        
        }

        return $url;
    }

    /**
     * 应用级参数
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @return void
     * @author 
     **/
    public function get_query_params($method, $params){
         if (in_array($method,array(WMS_SALEORDER_CANCEL,WMS_INORDER_CANCEL,WMS_OUTORDER_CANCEL))){
            $query_params = parent:: get_query_params($method, $params);
         }else{
            $query_params = array(
                'to_node_id' => $this->__channelObj->wms['shipper'],
                'method'     => $method,
            );
         }

        return $query_params;
    }

    /**
     * 签名
     *
     * @param Array $params 参数
     * @return void
     * @author 
     **/
    public function gen_sign($params,$method=''){
         if (in_array($method,array(WMS_SALEORDER_CANCEL,WMS_INORDER_CANCEL,WMS_OUTORDER_CANCEL))){

            return parent:: gen_sign($params);
         }else{
            return strtoupper(md5(strtoupper(md5(self::assemble($params)))));
         }
    }

    /**
     * 定义应用参数
     *
     * @return void
     * @author 
     **/
    public function define_query_params(){
        $params = array(
                'label' => 'ftp联接',
                'params' => array(
                    'url'     => '请求地址',
                    'node_id' => '节点',
                ));
        return $params;
    }
}