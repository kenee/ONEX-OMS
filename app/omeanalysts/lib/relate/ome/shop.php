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

class omeanalysts_relate_ome_shop{
    public function insert(&$data){
        $aData['relate_table'] = 'ome_shop';
        $aData['relate_key'] = $data['shop_id'];
        $relateObj = app::get('omeanalysts')->model("relate");
        $relate = $relateObj->dump(array('relate_table'=>'ome_shop','relate_key'=>$data['shop_id']));
        if(!isset($relate['relate_id']) && $aData['relate_key']){
            $relateObj->insert($aData);
        }
        return true;
    }

    /*
    public function delete($filter){
        if(is_array($filter) && $filter){
            $relateObj = app::get('omeanalysts')->model("relate");
            $delFilter['relate_table'] = 'ome_shop';
            $delFilter['relate_key'] = $filter['shop_id'];

            $relateObj->delete($delFilter);
        }
        return true;
    }
    */

    public function update($data){
        $aData['relate_table'] = 'ome_shop';
        $aData['relate_key'] = $data['shop_id'];
        $relateObj = app::get('omeanalysts')->model("relate");
        $relate = $relateObj->dump(array('relate_table'=>'ome_shop','relate_key'=>$data['shop_id']));
        if(!isset($relate['relate_id']) && $aData['relate_key']){
            $relateObj->insert($aData);
        }
        return true;
    }
}