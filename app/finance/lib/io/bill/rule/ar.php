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


class finance_io_bill_rule_ar{

    /**
     * 获取Params
     * @return mixed 返回结果
     */
    public function getParams(){
        $params = array(
            'read_line' => 2000,
            'relation' => array(
                'mfkey' => array(
                    1 => array('mkey'=>'*:业务流水号','fkey'=>'*:业务流水号'),
                    2 => array('mkey'=>'*:业务流水号','fkey'=>'*:业务流水号'),
                ),
            ),
            'public' => $public,
        );
        return $params;
    }

    /**
     * 获取Title
     * @return mixed 返回结果
     */
    public function getTitle(){
        $title = finance_io_bill_title::getTitle('ar');
        return $title;
    }

    /**
     * isTitle
     * @param mixed $row row
     * @param mixed $line line
     * @return mixed 返回值
     */
    public function isTitle($row,$line){
        return $sp = strpos(implode(',',$row),'*:')===false?false:true;
    }

    /**
     * isFilterLine
     * @param mixed $row row
     * @param mixed $line line
     * @return mixed 返回值
     */
    public function isFilterLine($row,$line){
        return false;
    }
}
?>