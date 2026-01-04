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

class base_cleandata{
    function clean($type="clean"){

        //清除node_id
        $config = base_setup_config::deploy_info();
        foreach($config['package']['app'] as $k=>$app){
            $applist[] = $app['id'];
        }

        foreach ($applist as $str_app_id){
            $app_xml = kernel::single('base_xml')->xml2array(file_get_contents(app::get($str_app_id)->app_dir.'/app.xml'),'base_app');
            if (isset($app_xml['node_id'])&&$app_xml['node_id']=="true"&&base_shopnode::node_id($str_app_id)){
                // 获取节点.
                base_shopnode::delete_node_id($str_app_id);
            }
        }

        //清除证书
        base_certificate::del_certificate();

        //清除shopex_id
        base_enterprise::set_enterprise_info(null);
    }

}
