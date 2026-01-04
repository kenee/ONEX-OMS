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

class ome_mdl_return_product_problem extends dbeav_model{

    
    /*
     * 获取类型名称
     */
    function getCatName($id=0){
        
       $filter = array('problem_id'=>$id);
       $catname = $this->dump($filter, 'problem_id,problem_name');
       return $catname['problem_name'];
    }
    
    /*
     * 获取类型
     */
   function getCatList($id=0){

       $catlist = $this->getList('problem_id,problem_name');
       if ($catlist){
	      return $catlist;
	   }else{
          return array();
	   }
   }

    
    
    /*
     * 仓库入库类型
     * 
     * @return array
     */
   function store_type(){
       $store_type = array('主仓','售后仓','残损仓');
       return $store_type;
   }
 /*
     * 仓库入库类型
     * @param int $store_type
     * @return array
     */
   function get_store_type($store_type){
    
       $store = $this->store_type();
  
       return $store[$store_type];
   }
 
}
?>
