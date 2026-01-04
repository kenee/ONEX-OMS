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

class purchase_appropriation_to_import {

    function run(&$cursor_id,$params)
    {
        $libBranchProductPos    = kernel::single('ome_branch_product_pos');
        
        $oAppropriation = app::get('purchase')->model('appropriation');
		$oBranchProduct = app::get('ome')->model('branch_product');
		$oBranchProductPos = app::get('ome')->model('branch_product_pos');
		$appropriationSdf = $params['sdfdata'];

        foreach ($appropriationSdf['list'] as $data){
		    $product_id = $data['product_id'];
			$to_branch_id = $data['to_branch_id'];
			$to_pos_id = $data['to_pos_id'];
		    $to_branch_product_pos = $oBranchProductPos->dump(array('pos_id'=>$to_pos_id,'product_id'=>$product_id),'*');
			if( !$to_branch_product_pos )
			{
			    $libBranchProductPos->create_branch_pos($product_id,$to_branch_id,$to_pos_id);
			}
			
			$adata[] = $data;
         }
		 
		 $oAppropriation->to_savestore($adata,'',$appropriationSdf['op_name']);
		 
        return false;
    }
}
