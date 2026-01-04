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

class taoguaninventory_mdl_encoded_state extends dbeav_model {
    /**
     * 获取编码状态信息
     */
    function get_state($name){
        $state = $this->dump(array('name'=>$name),'head,bhlen,currentno,eid');
        if($state){
            $currentno = $state['currentno'];
            $maxcurrentno = str_pad(9,$state['bhlen'],9,STR_PAD_LEFT);
            if($maxcurrentno==$currentno){
                    $currentno=0;
            }
            $currentno++;
            $state_bn = $state['head'].date('ymd').str_pad($currentno,$state['bhlen'],'0',STR_PAD_LEFT);
            $state['currentno'] = $currentno;
            $state['state_bn'] = $state_bn;
            return $state;
        }else{
            return false;
        }

    }


}
?>