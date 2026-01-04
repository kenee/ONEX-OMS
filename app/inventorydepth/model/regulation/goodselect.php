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

/**
 * @author chenping<chenping@shopex.cn>
 */

class inventorydepth_mdl_regulation_goodselect extends dbeav_model {

    public $tmp_filter = '';

    public function get_tmp_filter($init_bn) {
        if($this->tmp_filter) return $this->tmp_filter;

        $tmp_filter = kernel::single('inventorydepth_regulation_apply')->fetch_merchandise_filter($init_bn);

        return $tmp_filter;
    }
    public function getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null){
        $tmp_filter = $this->get_tmp_filter($filter['init_bn']);

        $list = parent::getList($cols, $tmp_filter, $offset, $limit, $orderType);

        return $list;
    }

    public function count($filter=null){
        $tmp_filter = $this->get_tmp_filter($filter['init_bn']);

        $count = parent::count($tmp_filter);

        return $count;
    }

    public function doRemove($init_bn,$id) {
        $tmp_filter = $this->get_tmp_filter($init_bn);
        if($tmp_filter['id'][0] == '_ALL_') {
            $tmp_filter['id|notin'] = array($id);
        }else{
            $key = array_search($id,$tmp_filter['id']);
            unset($tmp_filter['id'][$key]);
        }

        kernel::single('inventorydepth_regulation_apply')->store_merchandise_filter($init_bn,$tmp_filter);
        return true;
    }

    public function table_name($real=false){
        $table_name = 'shop_items';
        if($real){
            return kernel::database()->prefix.$this->app->app_id.'_'.$table_name;
        }else{
            return $table_name;
        }
    }

}
