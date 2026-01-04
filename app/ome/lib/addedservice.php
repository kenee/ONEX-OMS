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
 * value-added-service 增值服务
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class ome_addedservice
{
    /**
     * 检验是否购买服务
     * 
     * @return bool 
     * @author 
     */

    public function check_service($service_type)
    {
        if (defined('DEV_ENV')) {
            return true;
        }

        $service = $this->get_service($service_type);
        if(empty($service)){
            return false;
        }
        $expiration_time =  $service['expiration_time'];
        if ($expiration_time !== false) return $expiration_time > time() ? true : false;
    }

    #获取购买服务的信息
    public function get_service($service_type){
        $cacheKey = sprintf('value-added-services-%s',$service_type);
        $service = cachecore::fetch($cacheKey);
        #本地没有，到monitor获取
        if(is_null($service) || $service === false){
            $saasrequest =  new saasMonitor;
            $result = $saasrequest->check_service($_SERVER['SERVER_NAME'],$service_type);
            if(!$result)return false;
            #请求成功
            if ($result->success == 'true') {
                if (!$result->data) {
                    #未购买服务,也进行缓存一天
                    $service = '';
                    cachecore::store($cacheKey,$service,86400);
                    return false;
                } else {
                    #购买了服务
                    $service = (array) $result->data;
                    if (false !== strpos($service['expiration_time'], '-') || false !== strpos($service['expiration_time'], '/')) $service['expiration_time'] = strtotime($service['expiration_time']);
                    cachecore::store($cacheKey,$service,86400);
                    return  $service;
                }
            } elseif ($result->code) {
                #接口返回错误信息了
                $service  = '';
                cachecore::store($cacheKey,$service,86400);
                return false;
            }
        }else{
            return $service;
        }
    }
    
    //更新购买服务的信息(暂时是更新已经使用次数)
    /**
     * 更新_service
     * @param mixed $service_type service_type
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function update_service($service_type,$params){
        $node_id = base_shopnode::node_id('ome');
        $saasrequest =  new saasMonitor;
        $result = $saasrequest->update_service($node_id,$service_type,$params);
        if($result === false) return false;
        if ($result->success == 'true') {
            //清除缓存,保证再次拉取的是最新数据
            $cacheKey = sprintf('value-added-services-%s', $service_type);
            cachecore::store($cacheKey, '', 1);
            
            return true;
        } elseif ($result->code) {
            return false;
        }
    }

    /**
     * 删除服务缓存
     *
     * @return void
     * @author 
     **/
    public function delete_service($service_type)
    {
        $cacheKey = sprintf('value-added-services-%s',$service_type);

        cachecore::delete($cacheKey);
    }
}