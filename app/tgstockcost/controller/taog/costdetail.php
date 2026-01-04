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


class tgstockcost_ctl_taog_costdetail extends tgstockcost_ctl_costdetail
{
	function __consruct($app)
	{
		$this->app = $app;
		parent::__construct($app);
	}

	function download(){	
		$params = array();
		$this->finder('tgstockcost_mdl_stockdetail',$params);
	}

}