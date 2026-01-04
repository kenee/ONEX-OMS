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

class erpapi_store_response_process_stores
{
    /**
     * listing
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function listing($params){

        $filter = $params['filter'];

        $offset = $params['offset'];
        $limit = $params['limit'];
        $storeMdl = app::get('o2o')->model('store');

        $count = $storeMdl->count($filter);

        $rows = $storeMdl->getList('*', $filter, $offset, $limit);

        $lists = [];

        foreach ($rows as $row) {
            $area = $row['area'] ? explode(':',$row['area']) : '';


           

            $store = [
                'store_bn'       => $row['store_bn'],
                'store_name'     => $row['name'],
                'area'           => $area[1], 
                'addr'           => $row['addr'],  
                'open_hours'     => $row['open_hours'],
                'addr'           => $row['addr'],
                'zip'            => $row['zip'],
                'contacter'      => $row['contacter'],
                'mobile'         => $row['mobile'],
                'tel'            => $row['tel'],
                'status'         => $row['status'],
                'store_type'     => $row['store_type'],
                'store_mode'     => $row['store_mode'],
           
               
            ];

            $lists[] = $store;
        }

    
        $rs = array('rsp'=>'succ','data'=>array('lists'=>$lists,'count'=>$count));
        return $rs;

    }

    
}

?>