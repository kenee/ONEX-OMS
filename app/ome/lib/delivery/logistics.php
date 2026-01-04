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
	 * ShopEx licence
	 *
	 * @copyright  Copyright (c) 2005-2010 ShopEx Technologies Inc. (http://www.shopex.cn)
	 * @license  http://ecos.shopex.cn/ ShopEx License
	 * @version osc---hanbingshu sanow@126.com
	 */

	class ome_delivery_logistics extends ome_rpc_request
	{
		
		function __construct($app)
		{
			$this->app = $app;
			kernel::single('base_session')->start();
		}

		//获取物流跟踪信息
		function rpc_logistics_info($rpc_data)
		{
			$params['certi_id'] = base_certificate::certi_id();
			$params['method'] = 'logistics.trace.search';
			$params['date'] = time();
			$params['format'] = 'json';
			$params['logistics_code'] = $rpc_data['logistics_code'];
			if($rpc_data['valicode']) $params['valicode'] = $rpc_data['valicode'];
			if($_SESSION['set_cookie'])
			{
				$img_cookie_arr = explode(';',$_SESSION['set_cookie']);
				$img_cookie = trim($img_cookie_arr['0']);
			} 
			if($img_cookie)$params['set_cookie'] = $img_cookie;
			$params['tracking_no'] = $rpc_data['tracking_no'];
			$params['sign'] = $this->sign($params);
			$http = kernel::single('base_httpclient');
			$data = $http->set_timeout(15)->post(MATRIX_RELATION_URL . 'service',$params);
			return (json_decode($data,true));
			exit;

		}

		//查询物流信息前 验证码 向矩阵请求
		function get_verifycode($logistics_code)
		{
			$params['certi_id'] = base_certificate::certi_id();
			$params['method'] = 'logistics.kuaidi100.verifycode';
			$params['date'] = time();
			$params['format'] = 'json';
			$params['logistics_code'] = $logistics_code;
			$params['sign'] = $this->sign($params);
			$http = kernel::single('base_httpclient');
			$data = $http->set_timeout(15)->post(MATRIX_RELATION_URL . 'service',$params,$headers);
			if(is_array(json_decode($data,true))) return false;
			$_SESSION['set_cookie'] = $http->netcore->responseHeader['set-cookie'];
			$_SESSION['dly_verifycode'] = $data;
			return $data;
		}

		function sign($params)
		{
			$token = base_certificate::token();
		    if(!is_array($params))  return null;
		    ksort($params);
		    $sign = '';
		    foreach($params AS $key=>$val){
		        $sign .= $key . $val;
		    }
		    return strtoupper(md5(strtoupper(md5($sign)).$token));
		}

	}
?>