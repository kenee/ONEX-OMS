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

class wms_ctl_admin_serial extends desktop_controller{

    function ajaxCheckSerial(){
        $serialObj = $this->app->model('product_serial');
        $filter['serial_number'] = $_POST['serial'];
        $filter['bn'] = $_POST['bn'];
        $filter['branch_id'] = $_POST['bh_id'];
        $serialData = $serialObj->dump($filter);
        if($serialData['serial_id'] > 0 && $serialData['status'] == 0){
            echo json_encode(array('result' => 'true', 'msg'=>'OK'));
        }else{
            echo json_encode(array('result' => 'false', 'msg'=>'唯一码不存在或当前状态不可用'));
        }
    }

}