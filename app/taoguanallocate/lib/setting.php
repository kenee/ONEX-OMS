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

class taoguanallocate_setting{
    /**
     * view
     * @return mixed 返回值
     */
    public function view(){
        $settings = $this->all_settings();
        foreach($settings as $set){
            $key = str_replace('.','_',$set);
            $setData[$key] = app::get('ome')->getConf($set);
        }

        $render = kernel::single('base_render');
        $render->pagedata['setData'] = $setData;
        
        $html = $render->fetch('admin/setting.html','taoguanallocate');
        return $html;
    }
    
    function all_settings(){
        $all_settings =array(
             'taoguanallocate.appropriation_type',
            );
        return $all_settings;
    }
}
