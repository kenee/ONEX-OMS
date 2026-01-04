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

class ediws_task_shippackage {
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

        $this->syncShippackage();
        @set_time_limit(0);
        @ini_set('memory_limit','128M');
        ignore_user_abort(1);
        base_kvstore::instance('ediws/jd/shippackage')->fetch('apply-lastexectime',$lastExecTime);
        if($lastExecTime && ($lastExecTime+self::intervalTime)>self::$now) {
            return false;
        }
        
        $lastExecTime = $lastExecTime ? : (time()-7*86400);
        base_kvstore::instance('ediws/jd/shippackage')->store('apply-lastexectime', self::$now);

        //供应商编码列表
        $shopList = kernel::single('ediws_autotask_timer_accountsettlement')->getJdlwmiShop();

       
        if(empty($shopList)){
            $error_msg = '未配置供应商编码';
            return false;
        }

        $shippackage_flag = false;
        foreach ($shopList as $codeKey => $codeVal)
        {
            
            $config = $codeVal['config'];
            $vendorCode = $config['ediwsuser'];
            if($config['ediwssync'] != 'sync'){
               continue;
            }

            $sdf = array(
                'start_time'    =>$lastExecTime,
                'end_time'      =>self::$now,
                'shop_id'       =>$codeVal['shop_id'],
                'shop_bn'       =>$codeVal['shop_bn'],
                'shop_type'     =>$codeVal['shop_type'],
                'vendorcode'    =>$vendorCode,
            );
            $this->getShipPackage($sdf);
            
        }
        
        $this->syncShippackage();
        return true;
    }


    /**
     * 获取ShipPackage
     * @param mixed $data 数据
     * @return mixed 返回结果
     */
    public function getShipPackage($data) {

        $pageNo = 1;
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $bill_id = $data['bill_id'];
        
        do {

            $params = array(
                'providerCode'      =>  $data['vendorcode'],
                'createTimeBegin'   =>  date('Y-m-d H:i:s',$start_time),
                'createTimeEnd'     =>  date('Y-m-d H:i:s',$end_time),
                'pageIndex'         =>  $pageNo,
                'pageSize'          =>  50,
                'method'            =>  'edi.request.shippackage.getlist',

            );

            if($bill_id){
                $params['shipCode'] = $bill_id;
            }

            $rs = kernel::single('erpapi_router_request')->set('ediws',$data['shop_id'])->shippackage_getlist($params);
            
          
            if (empty($rs['data']['data']) || $rs['data']['recordCount']==0) {
                return true;
                break;
            }
            $count = $rs['data']['recordCount'];
            foreach ($rs['data']['data'] as $v) {
                
                $bill_params = array(
                    'providerCode'  =>  $data['vendorcode'],
                    'packageId'     =>  $v['packageId'],
                    'pageIndex'     =>  1,
                    'pageSize'      =>  50,
                    'method'        =>  'edi.request.shippackage.detail',
                );

                $billresult= kernel::single('erpapi_router_request')->set('ediws',$data['shop_id'])->shippackage_detail($bill_params);
                
               
                if (empty($billresult['data']['data'])) {
                    continue;
                }

                $main = $v;
                $main['shop_id']=$data['shop_id'];
                $main['shop_bn']=$data['shop_bn'];
                $main['shop_type']=$data['shop_type'];
                $main['items'] = $billresult['data']['data'];

                if($main){
                    kernel::single('ediws_event_trigger_jdlvmi')->addShippackage($main);
                }

            }

            if ($pageNo * $params['pageSize'] >= $count) {
                break;
            }

            $pageNo ++;
        } while(true);    
        


    }


    /**
     * syncShippackage
     * @return mixed 返回值
     */
    public function syncShippackage(){

        $vopreturnMdl = app::get('console')->model('vopreturn');
        $itemObj = app::get('console')->model('vopreturn_items');
        $vopreturns = $vopreturnMdl->getlist('*',array('status'=>'0','bill_status'=>'1','shop_type'=>'360buy'));
        foreach($vopreturns as $v){
            $id = $v['id'];
            $rs = kernel::single('ediws_jdlvmi')->autoConfirm($id);
        }

    }
    
    
}