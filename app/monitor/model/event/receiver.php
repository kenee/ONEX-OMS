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
 * @Author: xueding@shopex.cn
 * @Vsersion: 2022/10/13
 * @Describe: 预警配置model
 */
class monitor_mdl_event_receiver extends dbeav_model
{
    public function _filter($filter,$tableAlias=null,$baseWhere=null)
    {
        if ($filter['event_type']) {
            $findSql = '';
            foreach ($filter['event_type'] as $type) {
                $findSql .= "FIND_IN_SET('".$type."',event_type) AND ";
            }
            $filter['filter_sql'] = mb_substr($findSql,0,mb_strlen($findSql)-4);
            unset($filter['event_type']);
        }
        return parent::_filter($filter,$tableAlias,$baseWhere);
    
    }
    function modifier_event_type($type)
    {
        $eventTemplateLib = kernel::single('monitor_event_template');
        $eventType        = $eventTemplateLib->getEventType();
        $type = explode(',',$type);
        $typeName = '';
        if ($type) {
            foreach ($type as $name) {
                $typeName .= $eventType[$name].'，';
            }
        }
        
        return mb_substr($typeName,0,mb_strlen($typeName)-1);
    }
    
    function modifier_org_id($org_id)
    {
        $operationOrg = app::get('ome')->model('operation_organization')->getList('org_id,name',['org_id'=>explode(',', $org_id)]);
        $orgList        = implode(',',array_column($operationOrg,'name'));
        return $orgList;
    }
}