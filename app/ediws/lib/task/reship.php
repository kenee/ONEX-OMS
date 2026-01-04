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

class ediws_task_reship {
    /* 执行的间隔时间 */
    const intervalTime = 3600;

    /* 当前的执行时间 */
    public static $now;
   
    function __construct()
    {
        self::$now = time();
    }
    /**
     * 处理
     * @param mixed $params 参数
     * @param mixed $error_msg error_msg
     * @return mixed 返回值
     */
    public function process($params, $error_msg){

      
        @set_time_limit(0);
        @ini_set('memory_limit','128M');
        ignore_user_abort(1);
        base_kvstore::instance('ediws/jd/reship')->fetch('apply-lastexectime',$lastExecTime);
       if($lastExecTime && ($lastExecTime+self::intervalTime)>self::$now) {
            return false;
        }
        
        $lastExecTime = $lastExecTime ? : (time()-7*86400);
        base_kvstore::instance('ediws/jd/reship')->store('apply-lastexectime', self::$now);

         //供应商编码列表
        $shopList = kernel::single('ediws_autotask_timer_accountsettlement')->getJdlwmiShop();
        $reship_flag = false;
       
        if(empty($shopList)){
            $error_msg = '未配置供应商编码';
            return false;
        }

        foreach ($shopList as $codeKey => $codeVal)
        {
            $config = $codeVal['config'];
            $vendorCode = $config['ediwsuser'];
            if($config['ediwssync'] != 'sync'){
               continue;
            }
            $sdf = array(
                'start_time'=>$lastExecTime,
                'end_time'=>self::$now,
                'shop_id'       =>$codeVal['shop_id'],
                'shop_bn'       =>$codeVal['shop_bn'],
                'vendorcode'    =>$vendorCode,
            );

            $this->getReship($sdf);
            $reship_flag = true;
        }
        
        if($reship_flag){
            $this->syncReship();
        }
        
        return true;
    }


    /**
     * 获取Reship
     * @param mixed $data 数据
     * @return mixed 返回结果
     */
    public function getReship($data) {

        $pageNo = 1;
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $bill_id = $data['bill_id'];
        
        $shop_id = $data['shop_id'];


        if(!$data['vendorcode']){

            $shops = kernel::single('ediws_event_trigger_jdlvmi')->getShops($shop_id);

            $data['vendorcode'] = $shops['config']['ediwsuser'];
        }
        $requestPage = array(
            'currPage'         =>  $pageNo,
            'pageSize'          =>  50,
        );

        $param = array(

            'startCreateTime'   =>date('Y-m-d H:i:s',$start_time),
            'endCreateTime'     =>date('Y-m-d H:i:s',$end_time),
            'vendorCode'      =>  $data['vendorcode'],
        );
        $params = array(
            'requestPage'      =>  $requestPage,
            'param'             =>  $param,

            'method'            =>  'edi.request.reship.query',

        );


        if($bill_id){
            $params['shipCode'] = $bill_id;
        }
       
        $rs = kernel::single('erpapi_router_request')->set('ediws',$data['shop_id'])->reship_query($params);
     
        if (empty($rs['data']['data'])) {
            return true;
           
        }
        $dataList = $rs['data']['data'];

        foreach ($dataList as $v) {
           $v['shop_id'] =  $data['shop_id'];
           $rs = kernel::single('ediws_event_trigger_jdlvmi')->addReship($v);


        }

    }


    /**
     * syncReship
     * @return mixed 返回值
     */
    public function syncReship() {
        $reshipMdl = app::get('ediws')->model('reship');

        $reships = $reshipMdl->getList('*', array('sync_status' => '0','source'=>array('3','10')), 0, 500, 'reship_id asc');
        
        foreach ($reships as $key => $value) {
            $reship_id = $value['reship_id'];
            kernel::single('ediws_event_trigger_reship')->add($reship_id); 

        }

        
    }

    
}