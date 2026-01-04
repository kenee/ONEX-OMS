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
 * 客户分类Model类
 *
 * @author wangbiao@shopex.cn
 * @version 2024.06.12
 */
class material_mdl_customer_classify extends dbeav_model
{
    /**
     * 删除客户分类
     *
     * @param $data
     * @return bool
     */
    public function pre_recycle($data=null)
    {
        $salesMaterialObj = app::get('material')->model('sales_material');
        
        //delete
        foreach ($data as $val)
        {
            if(empty($val['class_id'])){
                continue;
            }
            
            $saleMaterialList = $salesMaterialObj->getList('sm_id', array('class_id'=>$val['class_id']),0,1);
            if($saleMaterialList){
                $this->recycle_msg = '客户分类编码：'. $val['class_bn'] .'已经被销售物料使用，无法删除！';
                
                return false;
            }
        }
        
        return true;
    }
}
