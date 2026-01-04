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

class finance_ctl_bill_order extends desktop_controller{
    var $name = "订单账单";
    /**
     * index
     * @return mixed 返回值
     */
    public function index(){
        /*
       if(empty($_POST)){
            $_POST['time_from'] = date("Y-n-d");
            $_POST['time_to'] = date("Y-n-d");
        }else{
            $_POST['time_from'] = $_POST['time_from'];
            $_POST['time_to'] = $_POST['time_to'];
        }
        */
        kernel::single('finance_bill_order')->set_params($_POST)->display();
    }

    /**
     * do_cancel
     * @return mixed 返回值
     */
    public function do_cancel(){
        $id = $_GET['id'];
        $data = array('res'=>'succ','msg'=>'');
        $billObj = &app::get('finance')->model('bill');
        $rs = $billObj->delete(array('bill_id'=>$id));
        if(!$rs){
            $data = array('res'=>'fail','msg'=>'作废不成功');
            echo json_decode($data);exit;
        }
        echo json_encode($data);
    }
}