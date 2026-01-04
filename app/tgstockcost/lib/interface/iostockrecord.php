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


interface tgstockcost_interface_iostockrecord
{

	/**
	*@params $branch_id 仓库ID $start_time 开始时间 2012-07-08 $end_time 结束时间 $bn 货号 多个用逗号隔开 
	*@params $offset 开始位置 $limit每页显示大小
	@return array() 出入库流水数据
	*获取仓库对应的货品出入库流水记录. 库存收发明细调用方法
	*/
	public function get_iostock($branch_id=null,$start_time=null,$end_time=null,$bn=null,$offset=0,$limit=-1);

	/*库存收发明细 组织数据导出方法
	*@params $data返回数据 $filter过滤条件 ...
	*@return bool
	*/
	public function fgetlist_csv(&$data,$filter,$offset,$exportType =1,$pass_data=false);
}