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
 * 基础物料的队列任务导入最终执行Lib类
 * 20160811
 * @author wangjianjun 
 * @version 0.1
 */

class o2o_branch_product_to_import {

    //门店基础物料关联的队列任务执行
    function run(&$cursor_id,$params){
        $importObj = app::get($params['app'])->model($params['mdl']);
        $dataSdf = $params['sdfdata'];
        
        $dataList    = array();
        
        foreach ($dataSdf as $v){
            $temp_rs = $importObj->dump(array("branch_id"=>$v["branch_id"],"bm_id"=>$v["bm_id"]));
            if(!empty($temp_rs)){
                //存在供货关系关联关系
                continue;
            }else{
                $importData = array(
                        'branch_id' => $v["branch_id"],
                        'bm_id' => $v["bm_id"],
                );
                $importObj->insert($importData);
                
                //[创建]淘宝门店关联宝贝
                $dataList[$v['branch_id']][$v['bm_id']]    = $v['bm_id'];
            }
        }
        
        //[批量创建]淘宝门店关联宝贝
        if($dataList)
        {
            foreach ($dataList as $branch_id => $bm_ids)
            {
                $storeItemLib    = kernel::single('tbo2o_store_items');
                $result          = $storeItemLib->batchCreate($bm_ids, $branch_id);
            }
        }
        
        return false;
    }
    
}
