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
 * 商品处理抽象类
 * 
 * @author wangbiao@shopex.cn
 * @version 0.1
 */
abstract class tbo2o_shop_service_common
{
    public $approve_status = array(
            array('filter'=>array('approve_status'=>'all'),'name'=>'全部','flag'=>'all'),
    );
    
    public $totalResults = 0;
    
    function __construct(&$app)
    {
        $this->app = $app;
    }
    
    /**
     * 获取上下架状态
     *
     * @return void
     * @author 
     **/
    public function get_approve_status($flag='', &$exist=false)
    {
        if (isset($this->approve_status[$flag]))
        {
            $exist = true;
            return $this->approve_status[$flag];
        }
        
        return $this->approve_status;
    }

    /**
     * @description
     * @access public
     * @param void
     * @return void
     */
    public function getTotalResults() 
    {
        return $this->totalResults;
    }

    /**
     * 下载全部商品(包含SKU)
     *
     * @return void
     * @author 
     **/
    public function downloadList($filter,$shop_id,$offset=0,$limit=200,&$errormsg)
    {
    }
}