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
 * @Author: xueding@shopex.cn
 * @Date: 2023/4/12
 * @Describe: 抖音response
 */
class erpapi_shop_matrix_luban_response_invoice extends erpapi_shop_response_invoice
{
    /**
     * 格式化发票传输数据
     * 
     * @param array $params
     * 
     * @return array:
     */

    protected function _formatMessagePush($params)
    {
        if ($params['extend_field'] && is_string($params['extend_field'])) {
            $params['extend_field'] = json_decode($params['extend_field'], true);
        }
        $sdf = array(
            'tid'            => $params['platform_tid'],
            'tax_title'      => $params['payer_name'],
            'register_no'    => $params['payer_register_no'],
            'title_type'     => $params['extend_field']['title_type'] == '1' ? '0' : '1', //发票属性。可选值：0（公司），1（个人）
            'invoice_amount' => $params['invoice_amount'],
        );
        
        //发票类型: ERP 0=纸质发票，1=电子发票
        if (!in_array($params['extend_field']['invoice_status_type'], ['0', '1'])) {
            $this->__apilog['result']['msg'] = '不支持的发票类型';
            return false;
        }
        
        $sdf['invoice_kind']                 = $params['extend_field']['invoice_status_type'] == '1' ? '1' : '2';
        $extend_arg['bank']                  = $params['bank_name'];
        $extend_arg['bank_account']          = $params['bank_no'];
        $extend_arg['registered_address']    = $params['company_address'];
        $extend_arg['registered_phone']      = $params['company_mobile'];
        $sdf['extend_arg']                   = $extend_arg;

        //不开运费开票金额取消运费
        if ('1' != app::get('ome')->getConf('ome.invoice.amount.infreight')) {
            $sdf['invoice_amount'] = $params['invoice_amount'] - $params['extend_field']['post_amount'];
        }
        
        return $sdf;
    }
    
}
