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

class ediws_event_trigger_reship {

   
    /**
     * 添加
     * @param mixed $reship_id ID
     * @return mixed 返回值
     */
    public function add($reship_id) {

        $reshipMdl = app::get('ediws')->model('reship');

        $reships = $reshipMdl->db_dump(array('reship_id'=>$reship_id,'source'=>array('3','10')),'*');


        $data = $this->formatReshipData($reships);
        
        
        if(empty($data)) return false;
        

        $rs = $this->masterro_add($data);

       
        $updata = array('sync_status'=>'2');
        if($rs['rsp'] != 'succ'){
            $updata['sync_status'] = '3';
            $updata['sync_msg'] = $rs['msg'];
        }
        $filter = array('reship_id'=>$reship_id);


        $reshipMdl->update($updata,$filter);
    }


   

    /**
     * formatReshipData
     * @param mixed $reships reships
     * @return mixed 返回值
     */
    public function formatReshipData($reships){
        $data = $reships;
        $reship_id = $reships['reship_id'];

        $itemsMdl = app::get('ediws')->model('reship_items');

        $items = $itemsMdl->getlist('*',array('reship_id'=>$reship_id));

        if(empty($items)) return array();
        $data['items'] = json_encode($items);

        return $data;

    }


    /**
     * masterro_add
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function masterro_add($params){


        $shop_id = $params['shop_id'];
       
       
        $addData= array(
            'original_bn'   => $params['reship_bn'],
            'original_id'   => $oldRow['id'],
            'branch_bn'     => $params['branch_bn'],
            'memo'          =>'JDMASTERRO',
          
            'bill_type'     => 'JDMASTERRO',
        );

        $jdlvmiLib = kernel::single('ediws_event_trigger_jdlvmi');
        $shops = $jdlvmiLib->getShops($shop_id);
        
        if($shops['config']['ediwbranch_bn']){
            $branchs = $jdlvmiLib->getBranch($shops['config']['ediwbranch_bn']);

            
            if($branchs){
                $addData['branch_id'] = $branchs['branch_id'];
            }else{
                $result = array('rsp'=>'fail','msg'=>'没有找到对应仓库:'.$params['branch_bn'].'');
                return $result;
            }
        }else{
            $result = array('rsp'=>'fail','msg'=>'仓库编码不可以为空');
            return $result;
        }
        $items = array();
        $detailInfoList = json_decode($params['items'],true);

        if(empty($detailInfoList)){
            $result = array('rsp'=>'fail','msg'=>'明细不可以为空');
            return $result;
        }
        

        $products = [];
      
        $materialObj= app::get('material')->model('basic_material');
        $edijdlLib = kernel::single('ediws_jdlvmi');
        foreach($detailInfoList as $v) {

           $skus = $edijdlLib->get_sku($shop_id,$v['skuid']);

           
            if(empty($skus)) {
                $result = array('rsp'=>'fail','msg'=>'没有前端店铺货号为'.$v['skuid'].'的货品');
                return $result;
                
            }
            
            $bn = $skus['shop_product_bn'];
      
            $bm = $materialObj->dump(array('material_bn'=>$bn),'material_bn,bm_id');
            
            if(empty($bm)){
                $result = array('rsp'=>'fail','msg'=>'没有货号为'.$bn.'的货品');
                return $result;
            }
            $product_id = $bm['bm_id'];

           
            $products[$product_id] = [
                'bn'        => $bn,
                'name'      => $v['skuname'],
                'nums'      => $v['actualnum'],
                'product_id'=> $product_id,
                'price'     => $v['price'],
                
            ];
            
        }
        if(empty($products)) {
            $result = array('rsp'=>'fail','msg'=>'明细不存在');
            return $result;
           
        }
        $addData['items'] = $products;
       
     
        kernel::database()->beginTransaction();
        list($rs,$msg) = $edijdlLib->_dealInItems($addData);

        if(!$rs){
            kernel::database()->rollBack();
            $result = array('rsp'=>'fail','msg'=>'入库单生成失败'.$msg['msg']);
            return $result;
        }
       
        kernel::database()->commit();

        if($msg['iso_id']){
            $edijdlLib->autocheckIso($msg['iso_id']);
            
        }
        if($rs){
            $result = array('rsp'=>'succ','msg'=>'成功');
        }else{
            $result = array('rsp'=>'fail','msg'=>$msg ? $msg : '失败');
        }

        return $result;
    }
    
}