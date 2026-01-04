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

class pos_ctl_orders extends desktop_controller
{
    
    
    function index() {
        
        $this->title='订单列表';
        $params = array(
            'title' => $this->title,
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>false,
            'use_buildin_export'=>false,
            'use_buildin_import'=>true,
            'use_buildin_importxls'=>true,
            'use_buildin_filter'=>true,
            'use_view_tab'=>true,
              
        );
        $this->finder('pos_mdl_orders', $params);
    }


    /**
     * import
     * @return mixed 返回值
     */
    public function import()
    {
        $this->display('admin/bill/import/bill.html');
    }


    /**
     * doImport
     * @return mixed 返回值
     */
    public function doImport()
    {
        set_time_limit(0);
        ini_set('memory_limit', '768M');

        $this->begin();

        list($rs, $msg) = kernel::single('pos_bill')->process($_FILES['import_file']);

        $this->endonly($rs ? true : false);

        if ($rs) {
            echo "<script>parent.$('iMsg').setText('导入完成');parent.$('import-form').getParent('.dialog').retrieve('instance').close();parent.finderGroup['" . $_GET['finder_id'] . "'].refresh();</script>";
            flush();
            ob_flush();
            exit;
        }
    }


}