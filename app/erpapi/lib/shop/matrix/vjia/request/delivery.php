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
 * 发货单处理
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_shop_matrix_vjia_request_delivery extends erpapi_shop_request_delivery
{

    /**
     * confirm
     * @param mixed $sdf sdf
     * @param mixed $queue queue
     * @return mixed 返回值
     */

    public function confirm($sdf,$queue=false)
    {
        // 只处理已发货与部分发货状态
        if ($sdf['status'] != 'succ' && !in_array($sdf['orderinfo']['ship_status'], array('1','2'))) return $this->succ('发货单未发货');
        
        // 先做出库操作
        $outstorageSdf = array(
            'order_bn' => $sdf['orderinfo']['order_bn'],
            'order_id' => $sdf['orderinfo']['order_id'],
        );

        $this->outstorage($outstorageSdf);

        return parent::confirm($sdf,$queue);
    }

    /**
     * 获取发货接口(默认线下发货)
     * 
     * @return void
     * @author 
     * */
    protected function get_delivery_apiname($sdf)
    {
        return SHOP_LOGISTICS_RESEND_CONFIRM;
    }


    /**
     * 出库操作
     * 
     * @return void
     * @author 
     * */
    public function outstorage($sdf)
    {
        // 整理参数格式
        $title = sprintf('出库操作[%s]',$sdf['order_bn']); 

        $params = array(
            'tid'          => $sdf['order_bn'],
            'company_code' => 'OTHER',
            'company_name' => '客户自提',
            'logistics_no' => sprintf('%u',crc32(uniqid())),
        );

        $callback = array(
           'class' => get_class($this),
           'method' => 'outstorage_callback',
           'params' => array(
                'order_id' => $sdf['order_id'],
                'obj_bn' => $sdf['order_bn'],
            ),
        );

        return $this->__caller->call(SHOP_TRADE_OUTSTORAGE, $params, $callback, $title,10,$sdf['order_bn']);
    }

        /**
     * outstorage_callback
     * @param mixed $response response
     * @param mixed $callback_params 参数
     * @return mixed 返回值
     */
    public function outstorage_callback($response, $callback_params)
    {
        $rsp     = $response['rsp'];
        $res     = trim($response['res']);
        $err_msg = $response['err_msg'];
        $order_id = $callback_params['order_id'];

        $outstorageObj = app::get('ome')->model('order_outstorage');
        if ($rsp == 'succ') {
            $outstorageObj->delete(array('order_id'=>$order_id));
        } else {
            $outstorage = array('order_id'=>$order_id);
            $outstorageObj->insert($outstorage);

            $orderModel = app::get('ome')->model('orders');
            $order = $orderModel->dump($order_id,'process_status');

            if ($order['process_status'] == 'unconfirmed') {
                $abnormalObj = app::get('ome')->model('abnormal');
                $abnormal = $abnormalObj->dump(array("order_id"=>$order_id));

                $msg = "出库失败(".($err_msg ? $err_msg : $res).")，system设置为异常订单，请检查前端订单状态！";
                $data = array(
                    'abnormal_id'      => $abnormal['abnormal_id'],
                    'order_id'         => $order_id,
                    'is_done'          =>'false',
                    'abnormal_memo'    => $msg,
                    'abnormal_type_id' => 0,
                );
                $orderModel->set_abnormal($data);
            }
        }

        return $this->callback($response, $callback_params);
    }

    /**
     * logistics_update
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function logistics_update($sdf)
    {
        // 整理参数格式
        $title = sprintf('修改物流信息[%s]',$sdf['orderinfo']['order_bn']); 

        $params = array(
            'tid'          => $sdf['orderinfo']['order_bn'],
            'company_code' => 'OTHER',
            'company_name' => '客户自提',
            'logistics_no' => sprintf('%u',crc32(uniqid())),
        );

        $callback = array(
           'class' => get_class($this),
           'method' => 'logistics_update_callback',
           'params' => array(
                'order_id' => $sdf['order_id'],
                'obj_bn' => $sdf['orderinfo']['order_bn'],
            ),
        );

        return $this->__caller->call(SHOP_LOGISTICS_CONSIGN_RESEND, $params, $callback, $title,10,$sdf['orderinfo']['order_bn']);
    }

    /**
     * logistics_update_callback
     * @param mixed $response response
     * @param mixed $callback_params 参数
     * @return mixed 返回值
     */
    public function logistics_update_callback($response, $callback_params)
    {
        return $this->callback($response, $callback_params);
    }
}