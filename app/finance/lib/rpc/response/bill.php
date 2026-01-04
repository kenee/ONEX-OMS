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
* 对账接口类
*/
class finance_rpc_response_bill extends ome_rpc_response{

    public function bill_list()
    {
        $params = $_POST;
        $res = array('res'=>'fail','msg'=>'','data'=>array());

        $params['start_time'] = strtotime($params['start_time']);

        $params['end_time'] = strtotime($params['end_time']);

        if(!$params['start_time'])
        {
            $res['msg'] = '没有开始时间';
            echo json_encode($res);exit;
        }

        if(!$params['end_time'])
        {
            $res['msg'] = '没有结束时间';
            echo json_encode($res);exit;
        }


        $page = $params['page'] ? intval($params['page']) : 1;

        $offset = ($page-1)*$limit;
        $limit = $params['limit']?$params['limit']:500;


        $mdlBill = app::get('financebase')->model('bill');

        $filter = array('status'=>2,'verification_time|between'=>array($params['start_time'],$params['end_time']));
        
        $count = $mdlBill->count($filter);

        $list = $mdlBill->getList('*',$filter,$offset,$limit);

        $res['data']['limit'] = $limit;
        $res['data']['total'] = $count;
        $res['data']['page'] = $page;
        $res['data']['list'] = $list;

        $res['res'] = 'succ';


        echo json_encode($res);exit;
    }

}