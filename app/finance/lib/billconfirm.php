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


class finance_billconfirm{

    /**
     * 获取账单信息
     * @access public
     * @param int $confirm_id 账单ID
     * @return Array
     */
    function dump($confirm_id=''){
        if (empty($confirm_id)) return NULL;

        $confirmModel = &app::get('finance')->model('bill_confirm');
        $filter = array('confirm_id'=>$confirm_id);
        $detail = $confirmModel->getList('*',$filter,0,1);
        return $detail[0];
    }

    /**
     * 无归属账单作废
     * @access public
     * @param mixed $filter 作废条件
     * @return bool
     */
    function cancel($filter){
        if (empty($filter)) return true;
        
        if (isset($filter['isSelectedAll']) && $filter['isSelectedAll'] == '_ALL_'){
            return $this->batch_delete($filter);
        }else{
            return $this->delete($filter);
        }
    }

    /**
     * 删除无归属账单
     * @access public
     * @param mixed $confirm_id 账单ID
     * @return bool
     */
    function delete($confirm_id){
        if (empty($confirm_id)) return true;

        $confirmModel = &app::get('finance')->model('bill_confirm');
        $filter = array('confirm_id'=>$confirm_id);
        return $confirmModel->delete($filter);
    }

    /**
     * 批量删除无归属账单
     * @access public
     * @param Array $filter 删除条件
     * @return bool
     */
    function batch_delete($filter=''){

        $confirmModel = &app::get('finance')->model('bill_confirm');
        $confirmModel->filter_use_like = true;
        return $confirmModel->delete($filter);
    }

}