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


class omecsv_ctl_admin_import extends omecsv_prototype
{

    /**
     * main
     * @return mixed 返回值
     */
    public function main()
    {
        // 防XSS
        $_GET = utils::htmlspecialchars_array($_GET);

        $render                        = kernel::single('desktop_controller');
        $render->pagedata['ctler']     = $_GET['ctler'];
        $render->pagedata['add']       = $_GET['add'];


        $get = kernel::single('base_component_request')->get_get();
        try {
            $oName = substr($get['ctler'], strlen($get['add'] . '_mdl_'));
            $model = app::get($get['add'])->model($oName);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo $msg;exit;
        }
        unset($get['app'], $get['ctl'], $get['act'], $get['add'], $get['ctler']);


        $render->pagedata['data'] = $get;

        if (method_exists($model, 'import_input')) {
            $render->pagedata['import_input'] = $model->import_input();
        }

        $render->display('common/import.html', 'omecsv');
    }
}
