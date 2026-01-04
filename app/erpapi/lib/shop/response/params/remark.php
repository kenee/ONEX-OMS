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
 * @author ykm 2016/5/17
 * @describe 添加商家备注 数据验证
 */

class erpapi_shop_response_params_remark extends erpapi_shop_response_params_abstract{

    protected function add(){
        return array(
            'process_status' => array(
                'type'=> 'enum',
                'required' => 'true',
                'errmsg' => '当前订单状态不能再更新,不接受！',
                'value' => array('unconfirmed','confirmed','splitting','splited')
            ),
            'ship_status' => array(
                'type'=>'enum',
                'in_out' => 'out',
                'value' => array('1'),
                'errmsg' => '订单已发货，不接受'
            ),
            'new_mark' => array(
                'type' => 'method',
                'method' => 'validAddNewMark',
                'errmsg' => '商家备注已经存在,不更新！'
            ),
        );
    }

    protected function validAddNewMark($params) {
        $remark = $params['mark_text'];
        if(!empty($remark)){
            foreach($remark as $val){
                if($val['op_content'] == $params['new_mark']['op_content']){
                    return false;
                }
            }
        }
        return true;
    }
}