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


$setting = array(
'site.decimal_digit.count'=>array('type'=>SET_T_ENUM,'default'=>2,'desc'=>'金额运算精度保留位数','options'=>array(0=>'整数取整',1=>'取整到1位小数',2=>'取整到2位小数',3=>'取整到3位小数')),
'site.decimal_type.count'=>array('type'=>SET_T_ENUM,'default'=>1,'desc'=>'金额运算精度取整方式','options'=>array('1'=>'四舍五入','2'=>'向上取整','3'=>'向下取整')),
'site.decimal_digit.display'=>array('type'=>SET_T_ENUM,'default'=>2,'desc'=>'金额显示保留位数','options'=>array(0=>'整数取整',1=>'取整到1位小数',2=>'取整到2位小数',3=>'取整到3位小数')),//WZP
'site.decimal_type.display'=>array('type'=>SET_T_ENUM,'default'=>1,'desc'=>'金额显示取整方式','options'=>array('1'=>'四舍五入','2'=>'向上取整','3'=>'向下取整')),
'system.area_depth'=>array('type'=>SET_T_INT,'default'=>'3','desc'=>'地区级数'),
);
