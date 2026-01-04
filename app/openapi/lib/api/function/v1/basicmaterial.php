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

class openapi_api_function_v1_basicmaterial extends openapi_api_function_abstract implements openapi_api_function_interface{

    /**
     * 获取List
     * @param mixed $params 参数
     * @param mixed $code code
     * @param mixed $sub_msg sub_msg
     * @return mixed 返回结果
     */
    public function getList($params,&$code,&$sub_msg){
        $filter = array();

        if ($params['material_bn']) {
            $filter['material_bn'] = $params['material_bn'];
        }

        if($params['start_time']){
            $filter['last_modified|bthan'] = strtotime($params['start_time']);
        }
        if($params['end_time']) {
            $filter['last_modified|sthan'] = strtotime($params['end_time']);
        }
        $page_no = intval($params['page_no']) > 0 ? intval($params['page_no']) : 1;
        $limit = (intval($params['page_size']) > 100 || intval($params['page_size']) <= 0) ? 40 : intval($params['page_size']);

        if($page_no == 1){
            $offset = 0;
        }else{
            $offset = ($page_no-1)*$limit;
        }

        $basic_material_data = kernel::single('openapi_data_original_basicmaterial')->getList($filter,$offset,$limit);
        return $basic_material_data;
    }
    
    /**
     * 添加
     * @param mixed $params 参数
     * @param mixed $code code
     * @param mixed $sub_msg sub_msg
     * @return mixed 返回值
     */
    public function add($params,&$code,&$sub_msg){
        //格式化参数是成品还是半成品(已弃用bind_info字段)
        if(isset($params['bind_info'])){
            if($params['material_type'] == 1){
                $tmp_basicMInfos = explode('|',$params['bind_info']);
                foreach($tmp_basicMInfos as $tmp_basicMInfo){
                    $tmp_bnInfo = explode(':',$tmp_basicMInfo);
                    $params['at'][$tmp_bnInfo[0]] = $tmp_bnInfo[1];
                }
            }
        }
        
        //(新)格式化参数是成品还是半成品，如果传了sub_items会代替bind_info
        $allowBindItemTypes = kernel::single('openapi_data_original_basicmaterial')->allowBindItemTypes;//1 成品 4 礼盒
        if (isset($params['sub_items']) && in_array($params['material_type'], $allowBindItemTypes)) {
            $sub_items = json_decode($params['sub_items'], true);
            if ($sub_items) {
                $params['at'] = [];
                foreach ($sub_items as $item) {
                    $params['at'][$item['material_bn']] = $item['material_num'];
                }
            }
        }
        $params['type'] = (in_array($params['material_type'],$allowBindItemTypes)) ? $params['material_type'] : 2;
        
        $rs = kernel::single('openapi_data_original_basicmaterial')->add($params,$code,$sub_msg);
        return $rs;
    }

    /**
     * edit
     * @param mixed $params 参数
     * @param mixed $code code
     * @param mixed $sub_msg sub_msg
     * @return mixed 返回值
     */
    public function edit($params,&$code,&$sub_msg){
        //格式化参数是成品还是半成品
        if(isset($params['bind_info'])){
            if($params['material_type'] == 1){
                $tmp_basicMInfos = explode('|',$params['bind_info']);
                foreach($tmp_basicMInfos as $tmp_basicMInfo){
                    $tmp_bnInfo = explode(':',$tmp_basicMInfo);
                    $params['at'][$tmp_bnInfo[0]] = $tmp_bnInfo[1];
                }
            }
        }
    
        //(新)格式化参数是成品还是半成品，如果传了sub_items会代替bind_info
        $allowBindItemTypes = kernel::single('openapi_data_original_basicmaterial')->allowBindItemTypes;//1 成品 4 礼盒
        if (isset($params['sub_items']) && in_array($params['material_type'], $allowBindItemTypes)) {
            $sub_items = json_decode($params['sub_items'], true);
            if ($sub_items) {
                $params['at'] = [];
                foreach ($sub_items as $item) {
                    $params['at'][$item['material_bn']] = $item['material_num'];
                }
            }
        }
    
        $params['type'] = (in_array($params['material_type'],$allowBindItemTypes)) ? $params['material_type'] : 2;
        $rs = kernel::single('openapi_data_original_basicmaterial')->edit($params,$code,$sub_msg);
        return $rs;
    }
}