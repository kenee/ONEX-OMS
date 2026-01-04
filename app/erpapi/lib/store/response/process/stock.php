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

class erpapi_store_response_process_stock
{
    

    /**
     * listing
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function listing($params){


        $rs = kernel::single('erpapi_front_response_process_o2o_material')->listing($params);


        return $rs;

    }



    /**
     * count
     * @param mixed $filter filter
     * @return mixed 返回值
     */
    public function count($filter){

        unset($filter['search']);
        $count = app::get('o2o')->model('branch_product')->count($filter);

        return array('rsp' => 'succ', 'data' => array('count' => $count));
    }
    
    
}

?>