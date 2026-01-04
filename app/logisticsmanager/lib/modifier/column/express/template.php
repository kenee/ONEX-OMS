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

class logisticsmanager_modifier_column_express_template {
    /**
     * columns_modifier
     * @param mixed $columns columns
     * @return mixed 返回值
     */
    public function columns_modifier(&$columns) {
        $tmpDetail=array();
        foreach($columns as $key=>$value){
            if (method_exists($this, $value[1] . '_display')) {
                  $displayMethod=$value[1] . '_display';
                  $isDisplay = $this->{$displayMethod}();
                        if ($isDisplay) {
                            $tmpDetail[$key]=$value;
                        }
            }else{
                $tmpDetail[$key]=$value;
            }
        }
        $columns=$tmpDetail;
    }

    /**
     * 是否默认
     */
    public function column_isdefault_display() {
        $display = false;
        if (in_array($_GET['act'], array('delivery', 'stock'))) {
            $display = true;
        }
        return $display;
    }
}
