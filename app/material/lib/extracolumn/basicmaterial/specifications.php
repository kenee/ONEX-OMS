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
 * 销售物料字段物料规格
 * @author
 * @version 1.0
 */

class material_extracolumn_basicmaterial_specifications extends desktop_extracolumn_abstract implements desktop_extracolumn_interface{

	protected $__pkey = 'bm_id';
	protected $__extra_column = 'column_specifications';

	/**
	 * 获取物料规格
	 * @params $ids
	 * @return array()
	 */
	public function associatedData($ids){
		$material_ext = app::get('material')->model('basic_material_ext');
		$specifications = $material_ext->getList('bm_id,specifications', array($this->__pkey=>$ids));

		$tmp_array= array();
		foreach($specifications as $k=>$row){
			$tmp_array[$row[$this->__pkey]] = $row['specifications'];
		}
		return $tmp_array;
	}

}