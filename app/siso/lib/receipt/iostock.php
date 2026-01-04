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

class siso_receipt_iostock extends siso_receipt_iostock_abstract{
    /**
     * 获取出入库业务类型列表
     * 
     * @return void
     */
    public function getIostockBillTypes($type_id=0)
    {
        $isoTypeObj = app::get('ome')->model('iso_type');
        
        //filter
        $filter = [];
        
        //指定出入库类型
        if($type_id){
            $filter['type_id'] = $type_id;
        }
        
        //list
        $billList = $isoTypeObj->getList('bill_type, bill_type_name', $filter);
        if($billList){
            $billList = array_column($billList, 'bill_type_name', 'bill_type');
            
            //系统定义的业务类型
            //@todo：系统定义的业务类型很多是未用上的,所以没有直接使用;
            //$isoObj = app::get('taoguaniostockorder')->model('iso');
            //$billTypes = $isoObj::$bill_type;
            
            $billTypes = [
                'oms_reship_diff' => '差异退货入库',
                'oms_reshipdiffout' => '差异退货出库',
                'vopjitrk' => '唯品会JIT入库单',
                'o2oprepayed'=> '门店预订单',
                'jdlreturn' => '京东自营',
            ];
            
            $billList = array_merge($billList, $billTypes);
        }
        
        return $billList;
    }
}
?>