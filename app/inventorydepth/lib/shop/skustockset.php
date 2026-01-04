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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0 
 * @DateTime: 2021/8/11 13:56:12
 * @describe: 销售商品成本
 * ============================
 */
class inventorydepth_shop_skustockset {
    private $branchInfo = [];

    private function getBranchBn($branch_id){
        if(isset($this->branchInfo[$branch_id])) {
            return $this->branchInfo[$branch_id]['branch_bn'];
        }
        $branch = app::get('ome')->model('branch')->db_dump(['branch_id'=>$branch_id,'check_permission'=>'false'], 'branch_bn');
        $this->branchInfo[$branch_id]['branch_bn'] = $branch['branch_bn'];
        return $this->branchInfo[$branch_id]['branch_bn'];
    }

    public function getShopSkuStockList($data) {
        if(empty($data['shop_product_bn'])) {
            return [];
        }
        $filter = [
            'shop_product_bn' => $data['shop_product_bn'],
            'mapping' => '1'
        ];
        $fields = 'id,shop_product_bn,shop_sku_id,shop_iid,shop_title';
        $shopSkus = app::get('inventorydepth')->model('shop_skus')->getList($fields, $filter);
        if(empty($shopSkus)) {
            return [];
        }
        $saleMaterialBn = array_unique(array_column($shopSkus, 'shop_product_bn'));
        $smStockRows = kernel::single('material_sales_material')->getSmBranchStock(['sales_material_bn'=>$saleMaterialBn]);
        if(empty($smStockRows)) {
            return [];
        }
        $smBranchStock = [];
        foreach ($smStockRows as $v) {
            $smBranchStock[$v['sales_material_bn']][$v['branch_id']] = $v;
        }
        $list = [];
        foreach ($shopSkus as $v) {
            if($smBranchStock[$v['shop_product_bn']]) {
                foreach ($smBranchStock[$v['shop_product_bn']] as $branch_id => $sv) {
                    $tmpRow = $v;
                    $tmpRow['branch_bn'] = $this->getBranchBn($branch_id);
                    $tmpRow['store'] = $sv['store'];
                    $tmpRow['store_freeze'] = $sv['store_freeze'];
                    $tmpRow['valid_stock'] = $sv['valid_stock'];
                    $list[] = $tmpRow;
                }
            }
        }
        return $list;
    }
}