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

class erpapi_store_response_process_aftersale
{
    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function add($params)
    {

        $aParams = $params;

        $rs = kernel::single('erpapi_router_response')->set_node_id($aParams['node_id'])->set_api_name('ome.aftersalev2.add')->dispatch($aParams);

        if ($rs['rsp'] != 'succ') {
            return $rs;
        }

        // step2 门店收货直接完成
        if ($params['status'] == 'SUCCESS') {
            $reship = $this->_formatReship($params);
            if($reship){
                $rs = kernel::single('erpapi_router_response')->set_channel_id($reship['store_id'])->set_api_name('store.reship.status_update')->dispatch($reship);

                if ($rs['rsp'] != 'succ') {
                    return $rs;
                }
            }

            
        }

        return $rs;

    }

    /**
     * _formatReship
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function _formatReship($params)
    {
        // 原销原退
        $filter = [
            // 'store_bn' => $params['warehouse_code']
            'store_bn' => $params['store_bn'],
        ];

        $storeMdl  = app::get('o2o')->model('store');
        $store     = $storeMdl->dump($filter, 'store_id');
        $reship_bn = $params['refund_id'];

        $reshipObj = app::get('ome')->model('reship');

        $reship = $reshipObj->dump(array('reship_bn' => $reship_bn, 'is_check' => array('0', '1')), '*');

        if (!$reship) {
            return false;
        }

        $reship_id = $reship['reship_id'];

        if ($reship['is_check'] == '0') {
            $this->AutoConfirmReship($reship_id);
        }
        $itemObj = app::get('ome')->model('reship_items');

        $items_list = $itemObj->getlist('*', array('reship_id' => $reship_id, 'return_type' => 'return'));
        if (!$items_list) {
            return false;
        }

        $data = [
            'reship_bn' => $reship['reship_bn'],
            'store_id'  => $store['store_id'],
            'status'    => 'FINISH',
            'warehouse' => $store['store_bn'],
        ];
        $refund_item_list = json_decode($params['refund_item_list'],true);
        $return_item = $refund_item_list['return_item'];

        $return_item = array_column($return_item, null, 'outer_id');
        $items = [];
        foreach ($items_list as $item) {
            
            if($return_item){
                $sn_list = $return_item[$item['bn']] ? $return_item[$item['bn']]['sn_list'] : '';
                
            }
           
            if ($items[$item['bn']]) {
                $items[$item['bn']]['normal_num'] += $item['num'];
            } else {
                $tmpItem = [
                    'defective_num' => 0,
                    'normal_num'    => $item['num'],
                    'bn'            => $item['bn'],
                    'sn_list'       => $sn_list, 
                ];

                

                $items[$item['bn']] = $tmpItem;
            }

        }

        $data['item'] = json_encode($items);
        return $data;

    }

    /**
     * 自动审核退货单
     * @param
     */
    public function AutoConfirmReship($reship_id)
    {
        $reshipLib = kernel::single('ome_reship');

        $data = array(
            'reship_id' => $reship_id,
            'status'    => '1',
            'is_anti'   => false,
            'exec_type' => 1,
            'from_source'=>'api',
        );
        $reshipLib->confirm_reship($data, $msg, $is_rollback);
    }
}
