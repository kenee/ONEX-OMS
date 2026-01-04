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


class ome_saas_service {
    
    private $site;
    
    /**
     * __construct
     * @param mixed $site site
     * @return mixed 返回值
     */
    public function __construct(ome_saas_site &$site) {
        $this->site = $site;
    }
    
    /**
     * @获取ome_saas_site实例化的对象
     * @access public
     * @param void
     * @return object
     */
    public function getSite(){
        return $this->site;
    }
    
    /**
     * @获取服务到期的剩余天数
     * @access public
     * @param void
     * @return int
     */
    public function getValidityDate() {
        return $this->site->getManager ()->getValidityDate ();
    }

    /**
     * @获取服务基本信息
     * @access public
     * @param void
     * @return int
     */
    public function getInfo() {
        return $this->site->getManager ()->getInfo ();
    }
    
}