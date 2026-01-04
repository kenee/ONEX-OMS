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

class erpapi_store_response_process_adjust
{
    

    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function add($params){

        list($rs, $rsData) = kernel::single('console_adjust')->dealSave($params);


        if(!$rs) {
            $result = array('rsp' => 'fail', 'msg' => '调账失败'.$rsData['msg']);
        }else{
            $result = array('rsp' => 'succ', 'msg' => '调账成功');
        }
        return $result;

    }

}

?>