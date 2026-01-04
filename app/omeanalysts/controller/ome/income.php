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

class omeanalysts_ctl_ome_income extends desktop_controller{
    public $__finder_params = array();

    function _views(){
        $pay_filter = array_merge($this->__finder_params,array('payments'=>'true'));
        $refunds_filter = array_merge($this->__finder_params,array('refunds'=>'false'));
        //error_log(var_export($refunds_filter,true),3,__FILE__.".log");
        $mdl_order = $this->app->model('ome_income');
        $sub_menu = array(
            0 => array('label'=>app::get('base')->_('全部'),'filter'=>$this->__finder_params,'optional'=>false),
            1 => array('label'=>app::get('base')->_('收款'),'filter'=>$pay_filter,'optional'=>false),
            2 => array('label'=>app::get('base')->_('退款'),'filter'=>$refunds_filter,'optional'=>false),
        );
        $i=0;
        foreach($sub_menu as $k=>$v){
            $sub_menu[$k]['filter'] = $v['filter']?$v['filter']:null;
            $sub_menu[$k]['addon'] = $mdl_order->count($v['filter']);
            $sub_menu[$k]['href'] = 'index.php?app=omeanalysts&ctl=ome_analysis&act=income&view='.$i++;
        }
        return $sub_menu;
    }
}