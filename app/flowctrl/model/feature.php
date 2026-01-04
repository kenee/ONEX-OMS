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
 * 特性模型层
 *
 * @author kamisama.xia@gmail.com 
 * @version 0.1
 */

class flowctrl_mdl_feature extends dbeav_model{

    var $defaultOrder = array('ft_id',' DESC');

    /**
     * 销售物料类型字段格式化
     * @param string $row 物料类型字段
     * @return string
     */
    function modifier_type($row){
        $flowctrlConfLib = kernel::single('flowctrl_conf');
        $nodeList = $flowctrlConfLib->getNodeList();
        if($nodeList){
            foreach($nodeList as $node){
                if($node['code'] == $row){
                    return $node['name'];
                }
            }
        }

        return "-";
    }

}
