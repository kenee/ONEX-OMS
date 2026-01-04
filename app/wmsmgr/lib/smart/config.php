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
 * 报价系统路由配置
 *
 * @author wangbiao@shopex.cn
 * @version 2024.08.22
 */
class wmsmgr_smart_config
{
    private $__config = array(
            'openapiwms' => array(
                'label' => '本地API直联',
                'platform' => array(),
                'desc' => '',
            ),
    );
    
    /**
     * __construct
     * @return mixed 返回值
     */

    public function __construct()
    {
        $openapi_platform = array (
            'publicwms' => array (
                    'label' => '标准',
                    'desc' => 'desc',
                    'params' => array(),
            ),
        );
        
        $this->__config['openapiwms']['platform'] = $openapi_platform;
    }

    /**
     * 获取Config
     * @return mixed 返回结果
     */
    public function getConfig()
    {
        return $this->__config;
    }

    /**
     * 获取AdapterList
     * @return mixed 返回结果
     */
    public function getAdapterList()
    {
        $adapter = array();
        foreach ($this->__config as $key => $value)
        {
            $adapter[] = array('value'=>$key, 'label'=>$value['label'], 'desc'=>$value['desc']);
        }
        
        return $adapter;
    }
    
    /**
     * 获取PlatformList
     * @param mixed $adapter adapter
     * @return mixed 返回结果
     */
    public function getPlatformList($adapter)
    {
        $platform = array();
        foreach ($this->__config[$adapter]['platform'] as $key => $value)
        {
            $platform[] = array('value'=>$key, 'label'=>$value['label']);
        }
        
        return $platform;
    }

    /**
     * 获取PlatformParam
     * @param mixed $platform platform
     * @return mixed 返回结果
     */
    public function getPlatformParam($platform)
    {
        return $this->__config['openapiwms']['platform'][$platform]['params'];
    }
}