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
 * 销售物料字段包装单位
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class material_extracolumn_basicmaterial_goodstype extends desktop_extracolumn_abstract implements desktop_extracolumn_interface{

    protected $__pkey = 'bm_id';
    protected $__extra_column = 'column_goods_type';

    /**
     *
     * 获取基础物料字段售价
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){
        //print_r($ids);
        $extObj = app::get('material')->model('basic_material_ext');
        $materialLists = $extObj->getList('cat_id,bm_id',array('bm_id' => $ids));
        $type_ids=array_column($materialLists,'cat_id');
        //根据发货单ids获取相应的信息
        $extObj = app::get('ome')->model('goods_type');
        $lists = $extObj->getList('name,type_id',array('type_id' => $type_ids));
        $tmp_goods_array= array();
        foreach($lists as $k=>$row){
            $tmp_goods_array[$row['type_id']] = $row['name'];
        }
        $tmp_array=array();
        //print_r($type_ids);
        foreach($materialLists as $key=>$val){
            $tmp_array[$val['bm_id']]=$tmp_goods_array[$val['cat_id']];
        }
        return $tmp_array;
    }

}
