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
abstract class erpapi_dealer_response_components_order_abstract
{
    protected $_platform = null;
    
    /**
     * convert
     * @return mixed 返回值
     */
    public function convert(){}
    
    /**
     * 更新
     * @return mixed 返回值
     */
    public function update(){}

    /**
     * 平台
     *
     * @return object
     **/
    public function setPlatform($platform)
    {
        $this->_platform = $platform;

        return $this;
    }

    /**
     * 比较数组值
     *
     * @return int
     **/
    public function comp_array_value($a,$b)
    {
        if ($a == $b) {
            return 0;
        }

        return $a > $b ? 1 : -1 ;
    }

    /**
     * 过滤空
     *
     * @return string
     **/
    public function filter_null($var)
    {
        return !is_null($var) && $var !== '';
    }
}