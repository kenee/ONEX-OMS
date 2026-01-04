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
 * 库存成本设置CTL
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class tgstockcost_ctl_setting extends desktop_controller
{
    /**
     * dialogSetting
     * @return mixed 返回值
     */

    public function dialogSetting()
    {
        $this->pagedata['tgstockcost']['setting'] = kernel::single('tgstockcost_system_setting')->getCostSetting();

        $this->display('admin/system/setting/dialogset.html');
    }

    /**
     * 保存
     * @return mixed 返回操作结果
     */
    public function save()
    {
        $this->begin();

        $rs = kernel::single('tgstockcost_system_setting')->setting_save($_POST['extends_set'],$msg);

        $this->end($rs,$msg);
    }

    /**
     * 初始化ial
     * @return mixed 返回值
     */
    public function initial()
    {
        $this->begin();
        $setting = kernel::single('tgstockcost_system_setting')->get_setting_value();
        // 写LOG
        $oplogModel = app::get('tgstockcost')->model('operation');
        $_tgcost['tgstockcost_cost'] = $setting['tgstockcost.cost'];
        $_tgcost['tgstockcost_get_value_type'] = $setting['tgstockcost.get_value_type'];
        $_tgcost['install_time'] = time();
        $_tgcost['op_id'] = kernel::single('desktop_user')->get_id();
        $_tgcost['op_name'] = kernel::single('desktop_user')->get_name();
        $_tgcost['operate_time'] = time();
        // $_tgcost['status'] = '1';//当前成本法
        $_tgcost['type'] = '2';

        $oplogModel->save($_tgcost);

        kernel::single("tgstockcost_instance_router")->create_queue();

        $this->end(true,'期初设置成功');
    }
}