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

class purchase_task{

    function post_install(){

        //唯品会仓库定义
        $purchaseLib    = kernel::single('purchase_purchase_order');
        $branch_list    = $purchaseLib->initWarehouse();
        
        if($branch_list)
        {
            $warehouseObj    = app::get('purchase')->model('warehouse');
            foreach ($branch_list as $key => $val)
            {
                $tempData    = $warehouseObj->dump(array('branch_bn'=>$val['branch_bn']), '*');
                if(empty($tempData))
                {
                    $data    = array('branch_bn'=>$val['branch_bn'], 'branch_name'=>$val['branch_name']);
                    $warehouseObj->save($data);
                }
            }
        }
    }

    function install_options(){
        return array(
                
            );
    }

}
