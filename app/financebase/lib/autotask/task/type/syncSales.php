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
 * 同步销售单
 *
 * @author 334395174@qq.com
 * @version 0.1
 */
class financebase_autotask_task_type_syncSales extends financebase_autotask_task_init
{

    /**
     * 处理
     * @param mixed $task_info task_info
     * @param mixed $error_msg error_msg
     * @return mixed 返回值
     */

    public function process($task_info,&$error_msg)
    {

        //判断是否安装不安装直接返回成功
        if(app::get('finance')->is_installed()){
            $res = kernel::single('finance_cronjob_tradeScript')->get_sales();


            // 根据AR表的更新时间查找对应的账期，更新账期金额
            if (is_array($res[2]) && $res[2]['sale_time_start'] && $res[2]['sale_time_end']) {
                // 通过monthly_report_items查询monthly_id
                $monthly_id = app::get('finance')->model('monthly_report_items')->getList('distinct monthly_id', [
                    'filter_sql' => 'up_time >= "'.date('Y-m-d H:i:s', $res[2]['sale_time_start']).'" and up_time <= "'.date('Y-m-d H:i:s', $res[2]['sale_time_end']).'"'
                ]);

                if ($monthly_id) {
                    $monthly_id = array_column($monthly_id, 'monthly_id');

                    finance_monthly_report::updateMonthlyAmount([
                        'monthly_id|in'=>$monthly_id
                    ]);
                }
            }
        }
        
        return true;
    }

}