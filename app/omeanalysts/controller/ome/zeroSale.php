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

class omeanalysts_ctl_ome_zeroSale extends desktop_controller{
		
	var $name = "零销售产品分析";

    /**
     * index
     * @return mixed 返回值
     */
    public function index(){
		if(empty($_POST)){
			$_POST['time_from'] = date("Y-m-1");
			$_POST['time_to'] = date("Y-m-d",time()-24*60*60);
		}
		kernel::single('omeanalysts_crontab_script_zeroSale')->statistics();
        kernel::single('omeanalysts_ome_zeroSale')->set_params($_POST)->display();
    }

}