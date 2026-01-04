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

class erpapi_store_response_process_replenish
{
   
   static public $sug_status=array(
        '0' => '未确认',
        '1' => '已确认',
        '2' => '已完成',
        '3' => '已作废',
    );
    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function add($params){
       
        

        $rs = kernel::single('console_replenish')->create($params, $msg);


        return array('rsp' => 'succ','data'=>array());
       
    }


    /**
     * listing
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function listing($params){
       
        $filter = $params['filter'];
        $replenish_suggestMdl     = app::get('console')->model('replenish_suggest');
        
        $offset = $params['offset'];
        $limit = $params['limit'];
        $count =$replenish_suggestMdl->count($filter);
        $replenish_suggestList = $replenish_suggestMdl->getlist('*',$filter, $offset, $limit);

        $sug_id_list = array_column($replenish_suggestList, 'sug_id');
        $itemsMdl = app::get('console')->model('replenish_suggest_items');

        $data = array();
        foreach($replenish_suggestList as $v){
            $sug_id = $v['sug_id'];
            $items =$itemsMdl->getlist('material_bn,apply_nums',array('sug_id'=>$sug_id));

            foreach($items as $k=>$iv){

                $material_bn = $iv['material_bn'];

                $barcode = kernel::single('material_codebase')->getBarcodeBybn($material_bn);
                $items[$k]['barcode'] = $barcode;
            }
            $data[] = array(
                'task_bn'       => $v['task_bn'],
                'sug_status'    => self::$sug_status[$v['sug_status']],
                'create_time'   => date('Y-m-d H:i:s', $v['create_time']),
                'items'         => $items,
            );

        }

        return array('rsp' => 'succ', 'data' =>array('lists' => $data, 'count' => $count));
    }


    
}

?>