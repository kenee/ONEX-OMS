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

class tgkpi_ctl_admin_analysis extends desktop_controller{

    /**
     * pick
     * @return mixed 返回值
     */
    public function pick(){ //捡货绩效统计
        kernel::single('tgkpi_analysis_pick')->set_params($_POST)->display();
    }

    /**
     * 检查
     * @return mixed 返回验证结果
     */
    public function check(){
        kernel::single('tgkpi_analysis_check')->set_params($_POST)->display();
    }

    /**
     * reason
     * @return mixed 返回值
     */
    public function reason(){
        kernel::single('tgkpi_analysis_reason')->set_params($_POST)->display();
    }
    #发货统计
    /**
     * delivery
     * @return mixed 返回值
     */
    public function delivery(){
        kernel::single('tgkpi_analysis_delivery')->set_params($_POST)->display();
    }

}