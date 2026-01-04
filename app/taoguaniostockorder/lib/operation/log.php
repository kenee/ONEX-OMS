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

class taoguaniostockorder_operation_log
{
    /**
     * 定义当前APP下的操作日志的所有操作名称列表
     * type键值由表名@APP名称组成
     * @access public
     * @return Array
     */
    function get_operations()
    {
        $operations = array(
            'create_iostock'  => array('name' => '新建出入库', 'type' => 'iso@taoguaniostockorder'),
            'docheck_iostock' => array('name' => '出入库审核', 'type' => 'iso@taoguaniostockorder'),
            'edit_iostock'    => array('name' => '出入库编辑', 'type' => 'iso@taoguaniostockorder'),
            'check_defective' => array('name' => '出入库残损确认', 'type' => 'iso@taoguaniostockorder'),
        );
        return array('taoguaniostockorder' => $operations);
    }
}

?>