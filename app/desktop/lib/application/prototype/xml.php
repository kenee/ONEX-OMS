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
 * 解析 desktop.xml 的基类
 */

class desktop_application_prototype_xml extends base_application_prototype_xml {

	/**
	 * 是否强制更新
	 */
	static $force_update = false;

     	function last_modified($app_id){

        	if (self::$force_update) {
            		return -1;
        	} else {

            		return parent::last_modified($app_id);
        	}
    	}
}
