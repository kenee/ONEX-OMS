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

class monitor_queue
{
    /**
     * 获取队列及队列中的数据总数
     * @author chenping@shopex.cn
     **/
    public function getQueues($source = 'pc')
    {
        if (defined('SERVICE_IN_SAAS')) {
            return [];
        }

        $queues = [];
        foreach (taskmgr_whitelist::get_all_task_list() as $key => $value) {
            if (!$value['name']){
                continue;
            }

            $queueName = taskmgr_swprocess_queue::getKey($key);
            $curCount = kernel::single('taskmgr_swprocess_queue')->count($queueName);

            $queues[$key]['name'] = $value['name'];
            $queues[$key]['count'] = $curCount;
            $queues[$key]['queueName'] = $queueName;
            // $queues[$key]['rate'] = '30/s';

            // 后面可针对队列做一些统计，比如平均响应时间，平均执行时间等等
        }
        $append = $this->getRedisFlow();
        $queues = array_merge($queues, $append);

        return $queues;
    }

    public function getRedisFlow()
    {
        $queues = [];

        $isRedis = ome_redis::publicConnectRedis();
        if (!$isRedis) {
            return $queues;
        }
        $redis = ome_redis::$publicRedis;

        $bpfHash  = kernel::single('ome_branch_product')->getFlowHash('freeze');
        $bpfCount = $redis->hlen($bpfHash);
        $queues['omeBranchPrduct_freeze'] = [
            'name'      =>  'Redis临时仓冻结流水',
            'count'     =>  $bpfCount,
            'queueName' =>  $bpfHash, 
        ];

        $bpsHash  = kernel::single('ome_branch_product')->getFlowHash('store');
        $bpsCount = $redis->hlen($bpsHash);
        $queues['omeBranchPrduct_store'] = [
            'name'      =>  'Redis临时仓库存流水',
            'count'     =>  $bpsCount,
            'queueName' =>  $bpsHash, 
        ];

        $msfHash  = kernel::single('material_basic_material_stock')->getFlowHash('freeze');
        $msfCount = $redis->hlen($msfHash);
        $queues['basicMaterialStock_freeze'] = [
            'name'      =>  'Redis临时商品冻结流水',
            'count'     =>  $msfCount,
            'queueName' =>  $msfHash, 
        ];

        $mssHash  = kernel::single('material_basic_material_stock')->getFlowHash('store');
        $mssCount = $redis->hlen($mssHash);
        $queues['basicMaterialStock_store'] = [
            'name'      =>  'Redis临时商品库存流水',
            'count'     =>  $mssCount,
            'queueName' =>  $mssHash, 
        ];

        return $queues;
    }
}
