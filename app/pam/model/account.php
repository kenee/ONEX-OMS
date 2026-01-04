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


class pam_mdl_account extends dbeav_model{
 var $has_many = array(
        'account'=>'auth:append',
    );
var $subSdf = array(
        'delete' => array(
            'account:auth' => array('*'),
         )
    );
	
	/**
	 * 得到帐号用户名
	 */
	public function get_operactor_name($account_id='')
	{
		if ($account_id == '')
			return app::get('pam')->_('未知或无操作员');
		
		$tmp = $this->getList('login_name',array('account_id'=>$account_id));
		if (!$tmp)
		{
			return app::get('pam')->_('未知或无操作员');
		}
		
		return $tmp[0]['login_name'];
	}
}
