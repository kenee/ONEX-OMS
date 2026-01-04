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

class brush_operation_log
{
    //刷单的发货操作日志
    function get_operations()
    {
        $operations = array(
               'delivery_brush_expre' => array('name'=> '发货单快递单打印','type' => 'delivery@brush'),
               'delivery_brush_modify' => array('name'=> '发货单快递单修改','type' => 'delivery@brush'),
               'delivery_brush_checkdelivery'=>array('name'=>'发货单发货处理','type' => 'delivery@brush'),
               'delivery_brush_getwaybill'=>array('name'=>'获取电子面单','type' => 'delivery@brush'),
               'delivery_brush_back'=>array('name'=>'发货单撤回','type' => 'delivery@brush'),
               'brush_farm_add'=>array('name'=>'特殊订单条件新增','type' => 'farm@brush'),
               'brush_farm_modify'=>array('name'=>'特殊订单条件编辑','type' => 'farm@brush'),
        );
        
        return array('brush'=>$operations);
    }
}
?>