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

class finance_ctl_monthend_detail extends desktop_controller{


    /**
     * index
     * @param mixed $monthly_id ID
     * @return mixed 返回值
     */
    public function index($monthly_id){

        $mdlMonthlyReport = $this->app->model('monthly_report');
        $this->report = $mdlMonthlyReport->getList('shop_id,bill_in_amount,bill_out_amount,ar_in_amount,ar_out_amount,begin_time,end_time,monthly_date,monthly_id',array('monthly_id'=>$monthly_id,'status'=>2),0,1);

        if(!$this->report) exit('Hack Attack');

        $this->report = $this->report[0];

        $this->base_filter = array('monthly_id'=>$this->report['monthly_id'],'status'=>2);

        $shop_info = app::get('ome')->model('shop')->getList('name',array('shop_id'=>$this->report['shop_id']),0,1);

        $this->report['shop_name'] = $shop_info[0]['name'];

        setcookie('MONTHEND_REPORT',json_encode($this->report,JSON_UNESCAPED_UNICODE),time()+1800,'/');



        if(isset($_GET['view']) and $_GET['view'] == 1)
        {
            $params = array(
                'title'=>sprintf("%s - %s - 应收应退单",$this->report['shop_name'],$this->report['monthly_date']),
                'actions'=>array(),
                'use_buildin_export'=>false,
                'use_buildin_recycle'=>false,
                'use_buildin_export'=>true,
                'use_buildin_import'=>false,
                'use_view_tab'=>true,
                'use_buildin_selectrow'=>true,
                'use_buildin_filter'=>true,
                'orderBy'=> 'ar_id desc',
                'base_filter' => $this->base_filter,
                'finder_cols'=>'ar_bn,channel_name,trade_time,member,type,order_bn,column_sale_money,column_fee_money,money,status,confirm_money,unconfirm_money,charge_status,charge_time,monthly_status,column_delete',
                'top_extra_view'=>array('finance'=>'monthed/report.html'),
            );
            $this->finder('finance_mdl_ar',$params);
        }
        else
        {
            $params = array(
                'title'=>sprintf("%s - %s - 实收实退单",$this->report['shop_name'],$this->report['monthly_date']),
                'actions'=>array(),
                'use_buildin_new_dialog' => false,
                'use_buildin_set_tag'=>false,
                'use_buildin_recycle'=>false,
                'use_buildin_export'=>true,
                'use_buildin_import'=>false,
                'use_view_tab'=>true,
                'use_buildin_selectrow' => true,
                'use_buildin_filter'=>true,
                'finder_aliasname'=>'ar_unsale',
                'finder_cols'=>'bill_bn,status,channel_name,fee_obj,member,trade_time,order_bn,fee_type,fee_item,money,bill_type',
                'base_filter' => $this->base_filter,
                'orderBy'=> 'bill_id desc',
                'top_extra_view'=>array('finance'=>'monthed/report.html'),
            );
            $this->finder('finance_mdl_bill',$params);
        }
    }

    function _views(){
        $mdlAr = $this->app->model('ar');
        $mdlBill = $this->app->model('bill');

        $sub_menu = array(
            0 => array('label'=>app::get('base')->_('实收实退单'),'filter'=>'','addon'=>$mdlBill->count($this->base_filter),'optional'=>false,'href'=>'index.php?app=finance&ctl=monthend_detail&act=index&p[0]='.$this->report['monthly_id'].'&view=0'),
            1 => array('label'=>app::get('base')->_('应收应退单'),'filter'=>'','addon'=>$mdlAr->count($this->base_filter),'optional'=>false,'href'=>'index.php?app=finance&ctl=monthend_detail&act=index&p[0]='.$this->report['monthly_id'].'&view=1'),
        );
        return $sub_menu;
    }


}