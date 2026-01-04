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

/*
 * 转仓入库
 * 20180528 by wangjianjun
 */
class console_event_trigger_warehousestockin extends console_event_trigger_stockinabstract{

    //获取数据
    function getStockInParam($param){
        $iostockObj = kernel::single('console_iostockdata');
        $iso_id = $param['iso_id'];
        $data = $iostockObj->get_warehouse_iostockData($iso_id);
        $data['io_type'] = 'WAREHOUSE';
        return $data;
    }

}
?>