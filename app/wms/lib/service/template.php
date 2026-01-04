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


class wms_service_template{
    /**
     * get print template list
     * 获取定义的快递单打印项的配置列表
     * @return array();
     */
    public function getElements(){
       return kernel::single('wms_delivery_template')->defaultElements();
    }


    /**
     * get default print content
     * 获取快递单打印项的对应内容
     * @param unknown_type $value_list
     * @return string
     */
    public function getElementContent($value_list){
        return kernel::single('wms_delivery_template')->processElementContent($value_list);
    }
}