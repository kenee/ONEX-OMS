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
 * 采购退货出库事件节点
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class flowctrl_node_purchasereturn_stockout extends flowctrl_node_abstract implements flowctrl_node_interface {

    protected $__Config = array(
        'html' => 'admin/node/conf/purchasereturn/stockout.html',
    );

    public function processModeToString($cnf){
        if($cnf['purchasereturn']['stockout'] == 'normal'){
            $string = "传统出库(货号、条码)";
        }elseif($cnf['purchasereturn']['stockout'] == 'batch'){
            $string = "批次出库";
        }

        return $string;
    }
}