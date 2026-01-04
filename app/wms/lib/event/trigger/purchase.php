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

class wms_event_trigger_purchase extends wms_event_trigger_stockinabstract{

    
    /**
     * 采购入库数据
     * @param   type    $data    需要转化数据
     * @return  type    array 
     * @access  public
     * @author
     */
    function getStockInData($data)
    {
        
        $po_id = $data['po_id'];
        $Po = app::get('purchase')->model("po")->dump($po_id,'eo_status,po_status,po_bn,supplier_id,branch_id');
        $oPo_items = app::get('purchase')->model("po_items");
        $tmp['io_type'] = 'PURCHASE';//类型
        $tmp['io_bn'] = $Po['po_bn'];//单号
     
        $tmp['status'] = $Po['po_status'];//采购状态
        $tmp['io_source'] = 'selfwms';//来源
        $tmp['memo'] = '';//备注
        $tmp['branch_id'] = $Po['branch_id'];
        $tmp['supplier_id'] = $Po['supplier_id'];
       
        $Po_items = array();

        $life_bills = $this->getStorageLifeList($Po['branch_id'], $po_id);

        $batchs = [];

        foreach($life_bills as $v){
            $expire_bn = $v['expire_bn'];
            $storagelife = $this->getlifedetail($Po['branch_id'],$v['bm_id'],$expire_bn);
           
            $productDate = $storagelife['production_date'] ? date('Y-m-d',$storagelife['production_date']) : '';
            $expireDate = $storagelife['expiring_date'] ? date('Y-m-d',$storagelife['expiring_date']) : '';
            $batchs[$v['bm_id']][$v['expire_bn']] = array(
              
                'purchase_code'     => $v['expire_bn'],

                'product_time'      => $storagelife['production_date'],
                'expire_time'       => $storagelife['expiring_date'],
                'normal_defective'  => 'normal',
                'num'               => $v['nums'],
               
            );

           
        }

        foreach($data['ids'] as $i){
            $v = intval($data['entry_num'][$i]);
            $k = $i;
            $items = $oPo_items->dump($k,'bn,product_id');
           
            #$amount+=$v*$Po_items['price'];
            $item_memo = $data['item_memo'][$k];
            if($batchs[$items['product_id']]){
                $batch = array_values($batchs[$items['product_id']]);
            }

            $Po_items[]=array(
               'normal_num'=>$v,
               'item_memo'=>addslashes($item_memo),
               'bn'=>$items['bn'],
               'batch'=>$batch,
             );

            
        }
        $tmp['items'] = $Po_items;
        return $tmp;
    } 


    /**
     * 获取StorageLifeList
     * @param mixed $branch_id ID
     * @param mixed $bill_id ID
     * @return mixed 返回结果
     */
    public function getStorageLifeList($branch_id, $bill_id){
        $basicMaterialStorageLifeBillsObj = app::get('material')->model('basic_material_storage_life_bills');
        $storageLifeBills = $basicMaterialStorageLifeBillsObj->getList( '*',array('branch_id'=>$branch_id, 'bill_id'=>$bill_id, 'bill_type'=>1, 'bill_io_type'=>1), 0, -1, 'bill_id asc, bmslb_id desc');



        return $storageLifeBills ? $storageLifeBills : '';
    }

    /**
     * 获取lifedetail
     * @param mixed $branch_id ID
     * @param mixed $bm_id ID
     * @param mixed $expire_bn expire_bn
     * @return mixed 返回结果
     */
    public function getlifedetail($branch_id,$bm_id,$expire_bn){

        $basicMaterialStorageLifeObj = app::get('material')->model('basic_material_storage_life');
        $storageLifeBatch = $basicMaterialStorageLifeObj->dump(array('branch_id'=>$branch_id, 'bm_id'=>$bm_id, 'expire_bn'=>$expire_bn),'production_date,expire_bn,expiring_date');

        return $storageLifeBatch;


    }

}

?>
