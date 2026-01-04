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

class omevirtualwms_finder_delivery{

    
    var $column_control = '操作';
	var $column_control_width = 100;
    function column_control($row){
    	$flag = "delivery";
        return '<a  href="index.php?app=omevirtualwms&ctl=admin_wms&act=getinfo&p[0]='.$row['delivery_bn'].'&p[1]='.$flag.'">开始模拟</a>';
    }

    function row_style($row)
    {
        if (in_array($row['delivery_bn'],(array)app::get('omevirtualwms')->model('delivery')->queue)) {
            return "\" style=\"background-color:#ffe3e7;\"";
        }
    }

    var $column_msg = '备注';
    var $column_msg_width = 400;
    var $column_msg_order = 200;
    function column_msg($row)
    {
        if (in_array($row['delivery_bn'],(array)app::get('omevirtualwms')->model('delivery')->queue)) {
            return app::get('omevirtualwms')->_(TIP_INFO);
        }
    }

}
