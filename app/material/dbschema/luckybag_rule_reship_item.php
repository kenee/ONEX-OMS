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
 * 售后换出福袋货品的规则关系表
 * 20180409 by wangjianjun
 */

$db['luckybag_rule_reship_item'] = array (
  'columns' => array(
    'reship_item_id' => array(
        'type' => 'number',
        'required' => true,
        'label' => '换货明细ID',
        'editable' => false,
    ),
    'lbr_id' => array(
        'type' => 'int unsigned',
        'required' => true,
        'label' => '福袋规则ID',
        'editable' => false,
    ),
  ),
  'index' => array(
    'ind_reship_item_id' => array('columns' => array(0 => 'reship_item_id')),
   ),
  'comment' => '售后换出福袋货品的规则关系表',
  'engine' => 'innodb',
  'version' => '$Rev:  $',
);