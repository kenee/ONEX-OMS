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


interface tgstockcost_interface_branch
{


	/*仓库货品表表名
	*@params $real 标示
	*@return string 表名字符串
	*/
	//public function table_name($real=false);



	/*获取FINDER列表上仓库货品表数据 成本查询数据获取方法 类似实现MODEL的getList方法
	*@params $cols 显示表字段 $filter 查询条件 $offset开始标记 $limint 每页显示数 $orderType 排序
	*@return array 仓库货品数据数组
	*/
	public function getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null);

	public function branchproduct_count($filter=array());

    public function header_getlist($cols = '*',$filter = array());
    
	/*获取FINDER列表上仓库货品表数据 收发汇总列表调用数据获取方法 类似实现MODEL的getList方法
	*@params $cols 显示表字段 $filter 查询条件 $offset开始标记 $limint 每页显示数 $orderType 排序
	*@return array 仓库货品数据数组
	*/
	public function stock_getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null);
	
	public function stock_count($filter=array());


	/*收发汇总列表 组织数据导出方法
	*@params $data返回数据 $filter过滤条件 ...
	*@return bool
	*/
	public function fgetlist_csv(&$data,$filter,$offset,$exportType =1,$pass_data=false);

	public function exportName(&$data);

	public function export_csv($data);
}