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

class finance_ctl_monthend extends desktop_controller{
    function index(){
        $params['use_buildin_recycle'] = false;
        $params['use_buildin_selectrow'] = false;
        // $finance_monthly_report = kernel::single("finance_monthly_report");
        // $finance_monthly_report->save_monthly_report();
        $params['title'] = '账期列表';
        $params['orderBy'] = ' monthly_id desc';

        if(!isset($_GET['view']) and $this->_views()[0])
        {
            $params['base_filter'] = $this->_views()[0]['filter'];
        }
        
        if (kernel::single('desktop_user')->has_permission('finance_bill_setting_init')) {
            $params['actions'] = [
                array(
                    'label'  => '账期设置',
                    'href'   => 'index.php?app=finance&ctl=setting_init&act=index',
                    'target' => "dialog::{width:550,height:400,resizeable:false,title:'账期设置'}"
                ),
            ];
        }
        $this->finder('finance_mdl_monthly_report',$params);
    }

    function _views(){
        $mdlMonthlyReport = $this->app->model('monthly_report');
        $list = $mdlMonthlyReport->getShopList();
        $sub_menu = array();

        if($list)
        {
            foreach ($list as $v) {
                $sub_menu[] = array('label'=>$v['name'],'filter'=>array('shop_id'=>$v['shop_id']),'addon'=>'_FILTER_POINT_','optional'=>false);
            }
        }

        return $sub_menu;
    }

    function closebook($monthly_id=null){
        #$this->index();
        if(empty($monthly_id)) return ;
        $this->pagedata['monthly_id'] = $monthly_id;
        $monthly_report = app::get('finance')->model("monthly_report");
        $aData = $monthly_report->getList('begin_time,end_time,shop_id',array('monthly_id'=>$monthly_id));
        $begin_time = $aData[0]['begin_time'];
        $end_time = $aData[0]['end_time'];
        $shop_id = $aData[0]['shop_id'];
        $finance_monthly_colsebook = kernel::single("finance_monthly_colsebook");
        $asc_row_status = $finance_monthly_colsebook->get_last_month_status($begin_time,$shop_id);

        if(!($asc_row_status==='2' || $asc_row_status==='0'))
        {
            $this->pagedata['asc_status_msg'] = "上个月份必须为“已结账”状态";
        }
        elseif(!$finance_monthly_colsebook->get_monthly_book_status($begin_time,$end_time,$shop_id,$msg)){
            $this->pagedata['book_status_msg'] = $msg;
        }

        $this->pagedata['auto_falg'] = $finance_monthly_colsebook->get_auto_flag_status($begin_time,$end_time,$auto_msg);
        $this->pagedata['auto_falgmsg'] = $auto_msg;
        $this->display("monthed/edit_status.html");
    }
    
    function cancelbook($monthly_id=null){
        $this->begin("index.php?app=finance&ctl=monthend&act=index");
        if(empty($monthly_id))
            $this->end(false,"月末结账ID不能为空");
        $monthly_report = app::get('finance')->model("monthly_report");
        $aData = $monthly_report->getList('begin_time,end_time,shop_id',array('monthly_id'=>$monthly_id));
        $begin_time = $aData[0]['begin_time'];
        $end_time = $aData[0]['end_time'];
        $shop_id = $aData[0]['shop_id'];
        $finance_monthly_colsebook = kernel::single("finance_monthly_colsebook");
        $next_row_status = $finance_monthly_colsebook->get_next_month_status($begin_time,$shop_id);
        #var_dump($next_row_status);exit;
        if($next_row_status == '2')
            $this->end(false,"请先取消下一个月的账单");
        elseif($finance_monthly_colsebook->colse_book($monthly_id,1))
            $this->end(true,"取消成功");
        else
            $this->end(false,"取消失败");
            
    }
    function edit_status(){
        $this->begin("index.php?app=finance&ctl=monthend&act=index");
        $monthly_id = $_POST['monthly_id'];
        if(empty($monthly_id))
            $this->end(false,"关账ID不能为空!");
        $finance_monthly_colsebook = kernel::single("finance_monthly_colsebook");
        if($finance_monthly_colsebook->colse_book($monthly_id,2))
            $this->end(true,"关账成功");
        else
            $this->end(false,"关账失败");

    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function reverify($monthly_id)
    {
        $this->begin();

        $monthly = app::get('finance')->model('monthly_report')->dump($monthly_id);

        if ($monthly['status'] == '2') {
            $this->end(false, '已关账');
        }

        app::get('finance')->model('ar')->update(array ('is_check'=>'0','status'=>'0','memo'=>'','gap_type'=>'','verification_status'=>'0','monthly_status'=>'0') ,array ('monthly_id' => $monthly_id));
        app::get('finance')->model('bill')->update(array ('is_check'=>'0','status'=>'0','memo'=>'','gap_type'=>'','verification_status'=>'0','monthly_status'=>'0'),array ('monthly_id' => $monthly_id));

        $this->end(true, '重置成功');
    }
}
