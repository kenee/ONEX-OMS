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

class ome_branch_flow_router
{
    private $_type = '';

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function __construct($type)
    {
        $this->_type = $type;
    }

    public function __call($method, $args)
    {
        // $type = array_shift($args);

        try {
            $object_name = 'ome_branch_flow_' . $this->_type;

            if (class_exists($object_name)) {
                $object_class = kernel::single($object_name);

                if (!method_exists($object_class, $method)) {
                    throw new Exception("method error");
                }

                return call_user_func_array(array($object_class, $method), $args);
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
