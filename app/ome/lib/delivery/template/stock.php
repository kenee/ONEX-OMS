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
 * 出货单模板
 *
 */
class ome_delivery_template_stock {
    protected $elements = array (
        'date_y'      => '当日日期-年',
        'date_m'      => '当日日期-月',
        'date_d'      => '当日日期-日',
        'date_ymd'      => '当日日期-年月日',
        'batch_number' => '批次号',
    );
    
    /**
     * 默认选项列表
     * Enter description here ...
     */
    public function defaultElements() {
        return $this->elements;
    }
}