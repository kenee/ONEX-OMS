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

class ome_rpc_response_saasmanager_omeanalysts
{

    function do_analyse_day($post,& $apiObj){
            $data = $this->fetch_by_interval('day');
            $run_day = strtotime($post['run_day']  . ' 00:00:00');
            switch($post['type']){
                case 'shop':
                    $service = kernel::single('omeanalysts_ome_shop');
                    break;
                default:
                    $apiObj->api_response('没有此统计类型');
            }
            if(!$service instanceof eccommon_analysis_interface)$apiObj->api_response('此方法没有实现接口：eccommon_analysis_interface');
            $run_task = false;
            $service_name = get_class($service);
            if(!isset($data[$service_name])){
                $new_service = array(
                        'service' => $service_name,
                        'interval' => 'day',
                );
                if($analysis_id = app::get('eccommon')->model('analysis')->insert($new_service)){
                    $run_task = true;
                }
            }elseif($data[$service_name]['modify']+86400 <= $run_day){  //1364140800
                $run_day = $data[$service_name]['modify']+86400;
                $run_task = true;
                $analysis_id = $data[$service_name]['id'];
                unset($data[$service_name]);
            }else{
                unset($data[$service_name]);
            }

            if($run_task){
                $analylogObj = app::get('eccommon')->model('analysis_logs');
                $rows = $service->get_logs($run_day);
                if($rows){
                    foreach($rows AS $row){
                        $analydata = $analylogObj->dump(array('analysis_id'=>$analysis_id,'flag'=>$row['flag'],'time'=>$run_day),'id');
                        $logs = array();
                        $logs['analysis_id'] = $analysis_id;
                        $logs['type'] = $row['type'];
                        $logs['target'] = $row['target'];
                        $logs['flag'] = $row['flag'];
                        $logs['value'] = $row['value'];
                        $logs['time'] = $run_day;
                        app::get('eccommon')->model('analysis_logs')->insert($logs);
                        $logs['id'] = $analydata['id'];
                        $analylogObj->save($logs);#todo save
                    }
                }
                app::get('eccommon')->model('analysis')->update(array('modify'=>$run_day), array('id'=>$analysis_id));
                $apiObj->api_response('统计成功');
            }else{
                $apiObj->api_response('没有统计成功');
            }
    }

    public function fetch_by_interval($interval){
        $rows = app::get('eccommon')->model('analysis')->getList('*', array('interval'=>$interval));
        foreach($rows AS $row){
            $data[$row['service']] = $row;
        }
        return $data;
    }

}
