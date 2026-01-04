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


class tgstockcost_ctl_stocksummary extends desktop_controller
{
    function __consruct($app)
    {
        $this->app = $app;
        parent::__construct($app);
    }
    
    function index()
    {
        $_POST['date_check'] = true;
        
        kernel::single('tgstockcost_stocksummary')->set_params($_POST)->display();
    }
    
    //检测查询时间是否跨成本法
    function checkedDate(){
        $obj_operation = app::get('tgstockcost')->model('operation');
        
        //检测查询时间是否合法
        $rs = $obj_operation->checkedDate($_POST['date_from'],$_POST['date_to']);
        echo json_encode($rs);
    }

    /**
     * 进销存CTL
     *
     * @return void
     * @author 
     **/
    public function sellstorage()
    {
        kernel::single('tgstockcost_stocksummary')->set_params($_POST)->display();
    }

}