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

class console_stockdump_to_import {

    function run(&$cursor_id, $params, &$errmsg= '')
    {

        $stockObj = app::get('console')->model('stockdump');
        $data = $params['sdfdata'];
        
        $options = array(
            'op_name'=>$data['op_name'],
            'from_branch_id'=>$data['from_branch_id'],
            'to_branch_id'=>$data['to_branch_id'],
            'memo'=>$data['memo'],
        );

        $appro_data = [];
        $result = $stockObj->to_savestore($data['items'],$options, $appro_data, $errmsg);

        if ($result) {
            $errmsg = null;

            kernel::single('console_iostockdata')->notify_stockdump($result['stockdump_id'],'create');
        }
        return false;
    }
}
