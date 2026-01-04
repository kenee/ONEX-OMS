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

abstract class inventorydepth_logic_abstract
{
    function __construct()
    {
        
    }

    public function check_condition($filter,$params)
    {
        $stockCalLib = kernel::single('inventorydepth_calculation_salesmaterial');
        list($object_key, $msg) = $stockCalLib->{'get_'.$filter['object']}($params);

        if($object_key === false) return false;

        $mathObj = kernel::single('inventorydepth_math');

        # 按百分比计算
        if ($filter['percent']=='true') {
            $objected_key = call_user_func_array(array($stockCalLib,'get_'.$filter['objected']),$params);

            if($objected_key === false) return false;

            if ($filter['comparison'] == 'between') {
                $objected_key_min = $objected_key * $filter['compare_increment'];
                $objected_key_min_comparison = $mathObj->get_comparison('bthan');

                $objected_key_max = $objected_key * $filter['compare_increment_after'];
                $objected_key_max_comparison = $mathObj->get_comparison('sthan');

                $expression = $object_key.$objected_key_min_comparison.$objected_key_min.' && '.$object_key.$objected_key_max_comparison.$objected_key_max;

                eval("\$result=$expression;");
                return $result;
            }else{
                $objected_key = $objected_key * $filter['compare_increment'];
                $comparison = $mathObj->get_comparison($filter['comparison']);
                
                $expression = $object_key.$comparison.$objected_key;
                eval("\$result=$expression;");
                return $result;
            }
        }else{
            # 按数值计算
            if ($filter['comparison'] == 'between') {
                $min_comparison = $mathObj->get_comparison('bthan');
                $max_comparison = $mathObj->get_comparison('sthan');

                $expression = $object_key.$min_comparison.$filter['compare_increment'].' && '.$object_key.$max_comparison.$filter['compare_increment_after'];

                eval("\$result=$expression;");
                return $result;
            }else{
                $comparison = $mathObj->get_comparison($filter['comparison']);

                $expression = $object_key.$comparison.$filter['compare_increment'];

                eval("\$result=$expression;");
                return $result;
            }
        }
    }
}