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
 * 门店关联地区数据类
 *
 * @access public
 * @author wangbiao<wangbiao@shopex.cn>
 * @version $Id: regions.php 2016-03-22 15:00
 */
class o2o_store_regions
{
    /**
     * 获取地区关联的层级地区信息
     * 
     * @param intval $region_id
     * @return Array
     */

    public function getRegionById($region_id)
    {
        $regionObj    = app::get('eccommon')->model('regions');
        
        $result    = array();
        $row       = $regionObj->dump(array('region_id'=>$region_id, 'disabled'=>'false'), 'region_path');
        if(empty($row))
        {
            return $result;
        }
        
        $region_ids    = array_filter(explode(',', $row['region_path']));
        $region_list   = $regionObj->getList('region_id, region_grade', array('region_id'=>$region_ids));
        foreach($region_list as $key => $val)
        {
            $region_grade             = $val['region_grade'];
            $result[$region_grade]    = $val['region_id'];
        }
        
        return $result;
    }
    
    /**
     * 批量获取地区名称
     * 
     * @param Array $region_ids
     * @return Array
     */
    public function getRegionByName($region_ids)
    {
        $regionObj    = app::get('eccommon')->model('regions');
        
        $result         = array();
        $region_list    = $regionObj->getList('region_id, local_name', array('region_id'=>$region_ids, 'disabled'=>'false'));
        if(empty($region_list))
        {
            return $result;
        }
        
        foreach($region_list as $key => $val)
        {
            $region_id             = $val['region_id'];
            $result[$region_id]    = $val['local_name'];
        }
        
        return $result;
    }
}
