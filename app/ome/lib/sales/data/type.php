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

class ome_sales_data_type{

    public static $__TYPE_LIST = array('goods','gift','pkg','giftpackage','lkb','pko');

    public static $__DEFAULT_TYPE = 'goods';

    /**
     * trans
     * @param mixed $type type
     * @param mixed $obj obj
     * @return mixed 返回值
     */
    public function trans($type,$obj){
        $type = strtolower($type);
        if (in_array($type, self::$__TYPE_LIST) || $type = self::$__DEFAULT_TYPE) {
            $objLib = kernel::single(sprintf('ome_sales_data_type_%s',$type));
            if (method_exists($objLib, 'doTrans')) {
                return $objLib->doTrans($obj);
            } else {
                return sprintf("方法doTrans不存在。");
            }
        } else {
            return sprintf("未知类型{$type}。");
        }
    }
}