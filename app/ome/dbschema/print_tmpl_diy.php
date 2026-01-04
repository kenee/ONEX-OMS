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


$db['print_tmpl_diy']=array (
  'columns' => 
  array (
    'tmpl_name' => array (
       'type' => 'varchar(50)',
       'pkey' => true,
       'required' => true,
    ),
    'app' => array (
       'type' => 'varchar(20)',
       'required' => true,
       'default' => 'ome',
       'editable' => false,
       'pkey' => true, 
    ),
    'content' => array(
        'type'=>'longtext',
        'label' =>app::get('ome')->_('内容'),
        'default' => 0,
    ),
    'edittime' => array (
      'type' => 'int(10) ',
      'required' => true,
    ),
    'active' => array(
        'type'=>"enum('true', 'false')",
        'default' => 'true',      
    ),
   
  ),   
  'comment' => app::get('ome')->_('信息表'),
   'engine' => 'innodb',
   'version' => '$Rev$',
);
