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
 * 关联后端商品导入最终执行Lib类
 *
 * @author wangbiao@shopex.cn
 * @version 0.1
 */
class tbo2o_shop_skus_to_import
{
    /**
     * 队列任务执行
     * 
     * @param String $cursor_id
     * @param Array $params
     * @param String $errmsg
     * @return Boolean
     */
    function run(&$cursor_id,$params,&$errmsg)
    {
        $importObj  = app::get($params['app'])->model($params['mdl']);
        
        $dataSdf    = $params['sdfdata'];

        foreach ($dataSdf as $v){
            $data = array(
                            'product_id' => $v['product_id'],
                            'product_bn' => $v['product_bn'],
                            'product_name' => $v['product_name'],
                            'is_bind_product' => 1,
                        );
            
            $is_save    = $importObj->update($data, array('id'=>$v['id']));
            if(!$is_save)
            {
                $m = $importObj->db->errorinfo();
                if(!empty($m)){
                    $errmsg.=$m.";";
                }
            }
         }
         
         return false;
    }
}