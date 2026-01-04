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

class ome_security_router
{
    private $__shop_type = null;

    /**
     * __construct
     * @param mixed $shop_type shop_type
     * @return mixed 返回值
     */
    public function __construct($shop_type)
    {
        $this->__shop_type = is_object($shop_type) ? '' : $shop_type;

        $this->__shop_type = str_replace('.','',$this->__shop_type);
        
        //平台兼容
        if($this->__shop_type == 'jd') {
            $this->__shop_type = '360buy';
        }elseif($this->__shop_type == 'tmall'){
            $this->__shop_type = 'taobao';
        }
    }

    /**
     * __call
     * @param mixed $method method
     * @param mixed $arguments arguments
     * @return mixed 返回值
     */
    public function __call($method,$arguments)
    {
        try {
            $object = kernel::single('ome_security_'.$this->__shop_type);

            return call_user_func_array(array($object,$method), $arguments);
        } catch (Exception $e) {
            $object = kernel::single('ome_security_hash');
            if (method_exists($object, $method)) {
                return call_user_func_array(array($object,$method), $arguments);
            }
        }

        return null;
    }

}