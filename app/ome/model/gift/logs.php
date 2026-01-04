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

class ome_mdl_gift_logs extends dbeav_model 
{
    //是否有导出配置
    var $has_export_cnf = true;

    var $export_name = '赠品发送记录';

    function searchOptions(){
        $parentOptions = parent::searchOptions();
        $childOptions = array(
            'gift_rule_name_has'=>app::get('ome')->_('赠品活动名称'),
            'shop_name_has'=>app::get('ome')->_('店铺名称'),
        );
        return $Options = array_merge($parentOptions,$childOptions);
    }

    /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter,$tableAlias=null,$baseWhere=null)
    {
        if($filter['gift_rule_name_has']) {
            $rule = app::get('ome')->model('gift_rule')->getList('id', array('title|has'=>$filter['gift_rule_name_has']));
            if(!$filter['gift_rule_id|in']) {
                $filter['gift_rule_id|in'] = array(0);
            }
            foreach ($rule as $v) {
                $filter['gift_rule_id|in'][] = $v['id'];
            }
            unset($filter['gift_rule_name_has']);
        }
        if($filter['shop_name_has']) {
            $shop = app::get('ome')->model('shop')->getList('shop_id', array('name|has'=>$filter['shop_name_has']));
            if(!$filter['shop_id|in']) {
                $filter['shop_id|in'] = array(0);
            }
            foreach ($shop as $v) {
                $filter['shop_id|in'][] = $v['shop_id'];
            }
            unset($filter['shop_name_has']);
        }
        return parent::_filter($filter, $tableAlias, $baseWhere);
    }
}