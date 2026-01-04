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

class console_foreignsku_import
{
    function run(&$cursor_id,$params)
    {
        $wfsObj = app::get('console')->model('foreign_sku');
        foreach($params['sdfdata'] as $k=>$value)
        {
            $inner_sku = trim($value['inner_sku']);
            $inner_sku = str_replace(array("'", '"'), '', $inner_sku);
            
            $wms_id = $value['wms_id'];
            
            //替换空格及特殊字符
            if($value['outer_sku'])
            {
                $value['outer_sku'] = trim($value['outer_sku']);
                $value['outer_sku'] = str_replace(array("'", '"'), '', $value['outer_sku']);
            }
            
            if($value['oms_sku'])
            {
                $value['oms_sku'] = trim($value['oms_sku']);
                $value['oms_sku'] = str_replace(array("'", '"'), '', $value['oms_sku']);
            }
            
            $foreign_detail = $wfsObj->getList('inner_sku',array('inner_sku'=>$inner_sku,'wms_id'=>$wms_id));
            if (empty($foreign_detail[0]['inner_sku']))
            {
                $wfsObj->insert($value);
            }
        }
        
        return false;
    }
}
?>