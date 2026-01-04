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

class o2o_mdl_server extends dbeav_model{

    function modifier_type($row){
        $type = o2o_conf_server::getTypeList($row);
        if($type){
            return $type['label'];
        }else{
            return '-';
        }
    }

    function pre_recycle($data)
    {
        $flag = true;
        $storeObj = app::get('o2o')->model('store');
        $arr_server = array();

        foreach($data as $val){
            $arr_server[] = $val['server_id'];
        }
        $row = $storeObj->getList('*',array('server_id' => $arr_server));
        if($row){
            $row2 = $this->getList('name',array('server_id' => $row[0]['server_id']));
            $this->recycle_msg = $row[0]['name'].'绑定了服务端：'.$row2[0]['name'].'，不能删除';
            $flag = false;
        }

        return $flag;
    }
}