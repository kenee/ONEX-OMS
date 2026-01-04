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

class ome_print_tmpl_logi_dangdang extends ome_print_tmpl_express{

    /**
     * __construct
     * @param mixed $controller controller
     * @return mixed 返回值
     */
    public function __construct($controller){
		$this->smarty = $controller;
	}

	public function setParams( $params = array() ){

		$message['tip1'] = '您现在使用的是 "当当代发物流" 模式，系统将自动将“当当订单号”作为“当当代发物流”的物流单号。';
		$message['tip2'] = '正式面单请使用“当当后台”进行打印。';
		$message['tip3'] = '在校验、发货 时,请扫描“当当后台”打印的面单，继续完成发货流程！';

		$this->smarty->pagedata['message'] = $message;

		return $this;
	}

    /**
     * 获取Tmpl
     * @return mixed 返回结果
     */
    public function getTmpl(){

        $this->smarty->singlepage("admin/delivery/express_printbyshipping.html");
        
	}

}