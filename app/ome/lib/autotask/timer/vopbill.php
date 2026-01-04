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

class ome_autotask_timer_vopbill {
    /* 执行的间隔时间 */
    const intervalTime = 21600;
    #脚本执行时间
    const loopTime = 900;
    /* 当前的执行时间 */
    public static $now;
    
    function __construct()
    {
        self::$now = time();
    }
    public function process($params, &$error_msg='')
    {
        @set_time_limit(0);
        @ini_set('memory_limit','128M');
        ignore_user_abort(1);

        $vopbill_set = app::get('ome')->getConf('ome.vopbill.set');

        if($vopbill_set!='on'){
            return true;
        }
        $this->getBillDetail();
        $this->getBillDiscountDetail();
        base_kvstore::instance('console/vop/bill')->fetch('apply-lastexectime',$lastExecTime);
        if($lastExecTime && ($lastExecTime+self::intervalTime)>self::$now) {
            return false;
        }
        
        $lastExecTime = $lastExecTime ? : (time()-7*86400);
     
        base_kvstore::instance('console/vop/bill')->store('apply-lastexectime', self::$now);
        //获取唯品会店铺
        $shopObj    = app::get('ome')->model('shop');
        $shopList   = $shopObj->getList('shop_id, shop_bn, name', array('node_type'=>'vop', 'node_id|noequal'=>'', 'tbbusiness_type'=>'jit'));
        if(empty($shopList))
        {
            return false;
        }
        
        foreach ($shopList as $key => $shop_info)
        {
            kernel::single('ome_event_trigger_shop_vopbill')->getBillNumber($lastExecTime, self::$now, $shop_info['shop_id']);
        }
        $this->getBillDetail();

        $this->getBillDiscountDetail();

    }

    public function getBillDetail() {
        do {
            $model = app::get('console')->model('vopbill');
            $filter = [
                'status' => '0',
                'sync_status' => '0',
                'create_time|than' => strtotime('-7 days')
            ];
            $oldRow = $model->db_dump($filter);
            if(!$oldRow) {
                $filter = [
                    'status' => '0',
                    'sync_status' => '1',
                    'last_modified|lthan' => (time() - 600)
                ];
                $oldRow = $model->db_dump($filter);
                if($oldRow) {
                    $model->update(['sync_status'=>'0'], ['id'=>$oldRow['id'], 'status'=>'0']);
                } else {
                    break;
                }
            }
            if($oldRow) {
                kernel::single('ome_event_trigger_shop_vopbill')->getBillDetail($oldRow);
                
            }
            if(time() > self::$now + self::loopTime) {
                break;
            }
        } while(true);
    }

    public function getBillDiscountDetail() {
        do {
            $model = app::get('console')->model('vopbill');
            $filter = [
                'status' => '0',
                'discount_sync_status' => '0',
                'create_time|than' => strtotime('-7 days')
            ];
            $oldRow = $model->db_dump($filter);
            if(!$oldRow) {
                $filter = [
                    'status' => '0',
                    'discount_sync_status' => '1',
                    'last_modified|lthan' => (time() - 600)
                ];
                $oldRow = $model->db_dump($filter);
                if($oldRow) {
                    $model->update(['discount_sync_status'=>'0'], ['id'=>$oldRow['id'], 'status'=>'0']);
                } else {
                    break;
                }
            }
            if($oldRow) {
                kernel::single('ome_event_trigger_shop_vopbill')->getBillDiscountDetail($oldRow);
                
            }
            if(time() > self::$now + self::loopTime) {
                break;
            }
        } while(true);
    }
}   