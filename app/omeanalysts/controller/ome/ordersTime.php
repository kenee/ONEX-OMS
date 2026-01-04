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


class omeanalysts_ctl_ome_ordersTime extends desktop_controller{

    /**
     * __construct
     * @param mixed $app app
     * @return mixed 返回值
     */
    public function __construct($app){
        parent::__construct($app);
        $timeBtn = array(
            'today' => date("Y-m-d"),
            'yesterday' => date("Y-m-d", time()-86400),
            'this_month_from' => date("Y-m-" . 01),
            'this_month_to' => date("Y-m-t"),
            'this_week_from' => date("Y-m-d", time()-(date('w')?date('w')-1:6)*86400),
            'this_week_to' => date("Y-m-d"),
            'sevenday_from' => date("Y-m-d", time()-7*86400),
            'sevenday_to' => date("Y-m-d", time()-86400),
        );
        $this->pagedata['timeBtn'] = $timeBtn;

    }

    function index(){
        //取所有店铺
        $shopObj = app::get('ome')->model('shop');
        $shopList = $shopObj->getList('shop_id,name');
        $this->pagedata['shopList']= $shopList;
        //下单时间分布情况crontab的手动调用
		//kernel::single('omeanalysts_crontab_script_ordersTime')->orderTime();
        if(empty($_POST)){
            $time = time();
            $year = date("Y",$time);
            $date = date("Y-m-d",mktime(0,0,0,1,1,$year));
            $date0 = date("Y-m-d",mktime(0,0,0,12,31,$year));
            $this->pagedata['time_from'] = strtotime($date);
            $this->pagedata['time_to'] = strtotime($date0);
        }else{
            $this->pagedata['time_from'] = strtotime($_POST['time_from']);
            $this->pagedata['time_to'] = strtotime($_POST['time_to']);
            $this->pagedata['shop_id'] = $_POST['ext_type_id'];
        }



        $args['shop_id'] = $_POST['ext_type_id']?$_POST['ext_type_id']:0;
        $this->pagedata['select_type'] = $args['shop_id'];
        $this->pagedata['form_action'] = 'index.php?app=omeanalysts&ctl=ome_ordersTime&act=index';
        $this->pagedata['path']= '下单时间分布情况 ';
        $this->pagedata['hash']= urlencode('#app=omeanalysts&ctl=ome_ordersTime&act=index');
        $this->page('ordersTime/frame.html');
    }

    function orders_time_map(){
        $data = $_GET;
        $orders_time = app::get('omeanalysts')->model('ordersTime');
        $orders_time_data = $orders_time->orders_time($data);
        $orders_time_map = array('0'=>'\'1点\'','1'=>'\'2点\'','2'=>'\'3点\'','3'=>'\'4点\'','4'=>'\'5点\'','5'=>'\'6点\'','6'=>'\'7点\'','7'=>'\'8点\'','8'=>'\'9点\'','9'=>'\'10点\'','10'=>'\'11点\'','11'=>'\'12点\'','12'=>'\'13点\'','13'=>'\'14点\'','14'=>'\'15点\'','15'=>'\'16点\'','16'=>'\'17点\'','17'=>'\'18点\'','18'=>'\'19点\'','19'=>'\'20点\'','20'=>'\'21点\'','21'=>'\'22点\'','22'=>'\'23点\'','23'=>'\'24点\'');

        $categories = implode(',',$orders_time_map);
        $volume = implode(',',$orders_time_data);
     	$this->pagedata['categories'] = '['.$categories.']';
     	$this->pagedata['data']='{
     		name: \'下单价分布图\',
     		data: ['.$volume.']
     	}';

        $this->display("ordersTime/chart_type_column.html");

    }
}
?>