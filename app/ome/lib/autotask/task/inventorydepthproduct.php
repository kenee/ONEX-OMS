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

/**
 * 按照已经拆分出来的销售物料进行库存回写
 */
class ome_autotask_task_inventorydepthproduct
{
    public function process($params, &$error_msg = '')
    {
        set_time_limit(0);
        ignore_user_abort(1);
        @ini_set('memory_limit', '1024M');
        $sdf = $params['sdf'];
        if($sdf['delivery_mode'] == 'self') {
            $this->stockSelf($sdf);
        }
        if($sdf['delivery_mode'] == 'shopyjdf') {
            $this->stockYjdf($sdf);
        }
        return true;
    }

    protected function stockSelf($params){
        $salesMaterialObj = app::get('material')->model('sales_material');
        $sm_ids = $params["sm_ids"];
        $shop_ids = $params["shop_ids"];
        if(!empty($sm_ids)){
            $products = $salesMaterialObj->getList('sm_id,sales_material_name,sales_material_bn, sales_material_type,shop_id',array('sm_id'=>$sm_ids));
            if(!empty($products)){
                kernel::single('inventorydepth_logic_stock')->set_readStoreLastmodify($params['read_store_lastmodify'])->do_sync_products_stock($products, $shop_ids);
            }
        }
    }

    protected function stockYjdf($params) {
        $salesMaterialObj = app::get('dealer')->model('sales_material');
        $sm_ids = $params["sm_ids"];
        $shop_ids = $params["shop_ids"];
        if(!empty($sm_ids)){
            $products = $salesMaterialObj->getList('sm_id,sales_material_name,sales_material_bn, sales_material_type,shop_id',array('sm_id'=>$sm_ids));
            if(!empty($products)){
                kernel::single('inventorydepth_logic_stock')->set_readStoreLastmodify($params['read_store_lastmodify'])->do_sync_products_stock($products, $shop_ids);
            }
        }
    }
}