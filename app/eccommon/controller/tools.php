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


class eccommon_ctl_tools extends desktop_controller{

    function __construct($app) {
        parent::__construct($app);
		header("cache-control: no-store, no-cache, must-revalidate");
        $this->app = $app;
    }

    //该方法desktop框架js会调用掉
    function selRegion(){
        $path = $_GET['path'];
        $depth = $_GET['depth'];

        $local = kernel::single('eccommon_regions_select');
        $filter_arr = array('depth'=>$depth);
        if($_GET['effect']){
            $filter_arr['effect'] = $_GET['effect'];
        }
        $ret = $local->get_area_select($path,$filter_arr);
        
        if($ret){
            echo '&nbsp;-&nbsp;'.$ret;exit;
        }else{
            echo '';exit;
        }
    }
}