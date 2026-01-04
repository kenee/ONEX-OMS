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
 * 物流包裹单列表
 *
 * @author wangbiao<wangbiao@shopex.cn>
 * @version $Id: Z
 */
class console_ctl_admin_delivery_bill extends desktop_controller
{
    var $name = '物流包裹单列表';
    var $workground = 'console_center';
    
    /**
     * 物流包裹列表
     */
    function index()
    {
        $actions = array();
        $base_filter = array();
        
        $params = array(
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'=>false,
            'use_buildin_recycle'=>false,
            'use_buildin_import'=>false,
            'use_buildin_export'=>true,
            'use_buildin_filter'=>true,
            'use_view_tab'=>true,
            'actions' => $actions,
            'title' => '物流包裹单列表',
            'base_filter' => $base_filter,
        );
        
        $this->finder('console_mdl_delivery_bill', $params);
    }

    function _views()
    {
        $dlyBillObj = app::get('console')->model('delivery_bill');
        
        $base_filter = array();
        $sub_menu = array(
            0 => array('label'=>app::get('base')->_('全部'), 'filter'=>array(), 'optional'=>false),
            1 => array('label'=>app::get('base')->_('未发货'), 'filter'=>array('status'=>array('0','3','5')), 'optional'=>false),
            2 => array('label'=>app::get('base')->_('已发货'), 'filter'=>array('status'=>array('1', '4')), 'optional'=>false),
            3 => array('label'=>app::get('base')->_('已签收'), 'filter'=>array('status'=>'4'), 'optional'=>false),
            4 => array('label'=>app::get('base')->_('已取消'), 'filter'=>array('status'=>'2'), 'optional'=>false),
        );
        
        foreach($sub_menu as $k => $v)
        {
            if(!IS_NULL($v['filter'])){
                $v['filter'] = array_merge($v['filter'], $base_filter);
            }
            
            $sub_menu[$k]['filter'] = $v['filter']?$v['filter']:null;
            $sub_menu[$k]['addon'] = $dlyBillObj->viewcount($v['filter']);
            $sub_menu[$k]['href'] = 'index.php?app=console&ctl='.$_GET['ctl'].'&act='.$_GET['act'].'&view='.$i++;
        }
        
        return $sub_menu;
    }
}
