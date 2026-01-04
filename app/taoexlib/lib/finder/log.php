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

class taoexlib_finder_log{
	var $detail_edit = '详细列表';
    function detail_edit($id){
        $render = app::get('taoexlib')->render();
        $oItem = kernel::single("taoexlib_mdl_log");
        $items = $oItem->getList('*',
                     array('id' => $id), 0, 1);
        $render->pagedata['item'] = $items[0];
        $render->display('admin/logdetail.html');
        //return 'detail';
    }	
}