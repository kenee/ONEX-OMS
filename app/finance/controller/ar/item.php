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

class finance_ctl_ar_item extends desktop_controller{
	var $name = "销售到账明细";
    /**
     * index
     * @return mixed 返回值
     */
    public function index(){
        /*
       if(empty($_POST)){
            $_POST['time_from'] = date("Y-n-d");
            $_POST['time_to'] = date("Y-n-d");
            $_POST['shop_id'] = 0;
        }else{
            $_POST['time_from'] = $_POST['time_from'];
            $_POST['time_to'] = $_POST['time_to'];
        }
        */
        kernel::single('finance_ar_item')->set_params($_POST)->display();
    }


}