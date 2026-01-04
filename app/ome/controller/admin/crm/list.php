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
 * User: jintao
 * Date: 2016/3/18
 * update by wangjianjun 20160830
 */
class ome_ctl_admin_crm_list extends desktop_controller{
    
    //赠品规则内搜索加载赠品列表
    /**
     * ajax_get_gifts
     * @return mixed 返回值
     */

    public function ajax_get_gifts(){
        $filter = array('is_del' => 0); //启用状态
        //根据赠品的编码和名称
        $s_gift_bn = isset($_POST['s_gift_bn']) ? trim($_POST['s_gift_bn']) : '';
        $s_gift_name = isset($_POST['s_gift_name']) ? trim($_POST['s_gift_name']) : '';
        if($s_gift_bn) $filter['gift_bn|has'] = $s_gift_bn;
        if($s_gift_name) $filter['gift_name|has'] = $s_gift_name;
        //赠品数据集
        $rs = app::get('crm')->model('gift')->getList('gift_id,gift_bn,gift_name,giftset,gift_num,product_id', $filter);
        //根据赠品数量设置条件过滤赠品数据集
        $result_arr = array();
        $stockLib = kernel::single('material_sales_material_stock'); //用来判选择项为实际库存数
        foreach($rs as $var_r){
            switch ($var_r["giftset"]){
                case "0": //指定数量 赠品库存必须大于0
                    if (intval($var_r["gift_num"])>0){
                        $result_arr[] = $var_r;
                    }
                    break;
                case "1": //不限数量 
                    $result_arr[] = $var_r;
                    break;
                case "2": //按实际库存 实际库存必须大于0
                    $store = $stockLib->getSalesMStockById($var_r['product_id']);
                    if($store>0){
                        $result_arr[] = $var_r;
                    }
                    break;
            }
        }
        //已勾选过的赠品
        $sel_goods = empty($_POST['sel_goods']) ?  '' : explode(',', $_POST['sel_goods']);
        if (!empty($result_arr)){
            foreach($result_arr as $k=>$v){
                //排除已勾选的
                if(in_array($v['gift_id'], $sel_goods)){
                    unset($result_arr[$k]);
                }
            }
        }
        echo(json_encode(array_values($result_arr)));
    }
    
}