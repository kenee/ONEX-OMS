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
/**
 * 云交易商品映射关系--渠道商品列表
 *
 * @author xueding@shopex.cn
 * @version 0.1
 */
class material_ctl_admin_material_channel extends desktop_controller
{
    /**
     * index
     * @return mixed 返回值
     */

    public function index()
    {
		if (empty($_POST)) {
			$_REQUEST['is_error'] = 1;
		}
        kernel::single('material_basic_material_channel')->set_params($_REQUEST)->display();
    }
}
