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
 * 按基础物料类型
 */
class omeauto_auto_type_materialtype extends omeauto_auto_type_abstract implements omeauto_auto_type_interface
{
    /**
     * 商品类型
     * 
     * @param object $tpl
     * @return void
     */
    public function _prepareUI(&$tpl)
    {
        $basicMaterialLib = kernel::single('material_basic_material');
        $tempList = $basicMaterialLib->get_material_types();
        
        $typeList = array();
        foreach ($tempList as $key => $val){
            if($val == '虚拟商品' || $val == '虚拟'){
                $typeList[$key] = $val;
            }
        }
        
        $tpl->pagedata['type_list'] = $typeList;
    }
    
    //检查输入的参数
    public function checkParams($params)
    {
        if (empty($params['material_type'])) {
            return "你还没有选择相应的基础物料类型\n\n请勾选以后再试！！";
        }
        
        return true;
    }

    /**
     * 生成规则字串
     *
     * @param Array $params
     * @return String
     */
    public function roleToString($params)
    {
        $basicMaterialLib = kernel::single('material_basic_material');
        $tempList = $basicMaterialLib->get_material_types();
        
        $caption = '';
        foreach ($tempList as $key => $val)
        {
            if($key == $params['material_type']){
                $caption = sprintf('订单明细中包含 [%s] 类型的基础物料', $val);
            }
        }
        
        $role = array('role'=>'materialtype', 'caption'=>$caption, 'content'=>array('material_type'=>$params['material_type']));
        
        return json_encode($role);
    }

    /**
     * 检查订单数据是否符合要求
     * 
     * @param omeauto_auto_group_item $item
     * @return boolean
     */
    public function vaild($item)
    {
        if(!empty($this->content)) {
            //基础物料类型
            $material_type = intval($this->content['material_type']);
            
            //获取订单明细中的基础物料
            $arrProductId = array();
            foreach ($item->getOrders() as $order)
            {
                foreach ($order['objects'] as $objKey => $objVal)
                {
                    foreach ($objVal['items'] as $itemKey => $itemVal)
                    {
                        $product_id = $itemVal['product_id'];
                        $arrProductId[$product_id] = $product_id;
                    }
                }
            }
            
            //获取虚拟商品
            $basicMaterialObj = app::get('material')->model('basic_material');
            $tempList = $basicMaterialObj->getList('*', array('bm_id'=>$arrProductId));
            
            //获取规则中的基础物料
            $virtualBns = array();
            foreach ($tempList as $key => $val)
            {
                $bm_id = $val['bm_id'];
                
                if($val['type'] == $material_type){
                    $virtualBns[$bm_id] = $val['material_bn'];
                }
            }
            
            if(empty($virtualBns)){
                return false;
            }
            
            return true;
        } else {
            return false;
        }
    }
}