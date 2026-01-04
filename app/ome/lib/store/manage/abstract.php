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
 * @description 库存管理抽象类
 * @access public
 */
abstract class ome_store_manage_abstract{

    protected $_is_ctrl_store = true;

    function __construct($is_ctrl_store){
        $this->_is_ctrl_store = $is_ctrl_store;
    }

    protected function _sortAddBmNum($items, $bmIdField='product_id', $numField='number') {
        $nitems         = array();

        foreach ($items as $item) {
            if (isset($nitems[$item[$bmIdField]])) {
                $nitems[$item[$bmIdField]][$numField] += $item[$numField];
            } else {
                $nitems[$item[$bmIdField]] = array(
                    $bmIdField => $item[$bmIdField],
                    $numField => $item[$numField],
                );
            }

        }

        ksort($nitems);

        return $nitems;
    }
}
