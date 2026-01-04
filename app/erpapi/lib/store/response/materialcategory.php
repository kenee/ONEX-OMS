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

class erpapi_store_response_materialcategory extends erpapi_store_response_abstract
{
    

    /**
     * listing
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function listing($params){
        $filter = array();

        if($params['start_time'] && $params['end_time']){
            $filter['last_modify|between'] = array(strtotime($params['start_time']), strtotime($params['end_time']));
        }


        $page_no = intval($params['page_no']) > 0 ? intval($params['page_no']) : 1;
        $limit = (intval($params['page_size']) > 100 || intval($params['page_size']) <= 0) ? 40 : intval($params['page_size']);

        if($page_no == 1){
            $offset = 0;
        }else{
            $offset = ($page_no-1)*$limit;
        }

        $data = array(

            'filter'    =>  $filter,
            'offset'    =>  $offset,
            'limit'     =>  $limit,
        );


        return $data;
    }
}

?>