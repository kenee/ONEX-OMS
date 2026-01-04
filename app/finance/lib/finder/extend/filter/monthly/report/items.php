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

class finance_finder_extend_filter_monthly_report_items{
    function get_extend_colums(){
        $db['monthly_report_items']=array (
            'columns' => array (
                'gap' => [
                    'type' => 'money',
                    'label' => 'GAP',
                    'in_list' => true,
                    'default_in_list' => true,
                    'order' => 110,
                    'filtertype' => 'normal',
                    'filterdefault' => true,
                ],
            )
        );
        return $db;
    }
}

