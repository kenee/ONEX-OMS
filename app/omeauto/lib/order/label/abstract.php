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
 * 订单标签规则抽象类
 *
 * @author wangbiao@shopex.cn
 * @version $Id: Z
 */
abstract class omeauto_order_label_abstract
{
    /**
     * 保存规则内容
     * 
     * @var Array
     */
    protected $content;
    
    /**
     * 设置已经创建好的配置内容
     */
    public function setRole($params)
    {
        $this->content = $params;
    }
}