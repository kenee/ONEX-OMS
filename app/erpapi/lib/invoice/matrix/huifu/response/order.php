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
 * 发票-接口响应类
 *
 */
class erpapi_invoice_matrix_huifu_response_order extends erpapi_invoice_response_order
{
    protected function _formatUpdateParams($params)
    {
        $data = [];
        foreach ($this->invoiceResponse['success'] as $key => $invoiceResult) {
            $invOrderMdl = app::get('invoice')->model('order');
            $eleMdl = app::get('invoice')->model('order_electronic_items');
            $serialNo = $invoiceResult['omsSerialNo'] ? $invoiceResult['omsSerialNo'] : $invoiceResult['serialNo'];
            $invEle                        = $eleMdl->db_dump(['serial_no' => $serialNo], 'id,billing_type');
            $invOrder                      = $invOrderMdl->db_dump(['id' => $invEle['id']], 'order_bn,invoice_apply_bn');
            $this->__apilog['original_bn'] = $invOrder['order_bn'] ?: $invoiceResult['serialNo'];
            $this->__apilog['title']       = '开票结果更新-' . $invoiceResult['serialNo'];
            if (empty($invoiceResult['invoiceType'])) {
                $invoiceResult['invoiceType'] = $invEle['billing_type'] == '1' ? '0' : '1';
            }
            //红冲参数兼容  //冲红成功 状态更新
            if ($invoiceResult['invoiceType'] == '1') {
                $status = $invoiceResult['invoiceStatus'];
                if ($status == '10') {
                    $invoiceResult['invoiceStatus'] = '20';
                }elseif ($status == '00') {
                    $invoiceResult['invoiceStatus'] = '05';
                }
            }
            $data[$key] = array (
                'serial_no'        => $invoiceResult['serialNo'],  // 流水号
                'invoice_apply_bn' => $invOrder['invoice_apply_bn'] ?: $invoiceResult['serialNo'],  // 流水号
                'invoice_code'     => $invoiceResult['invoiceCode'],         // 发票代码,数电没有
                'invoice_no'       => $invoiceResult['invoiceNo'],    // 发票号码
                'invoice_date'     => strtotime($invoiceResult['invoiceDate']),  // 开票日期
                'invoice_type'     => $invoiceResult['invoiceType'],  // 开票类型 0:蓝，1:红
                'url'              => $invoiceResult['eInvoiceUrl'],   // PDFURL
                'invoice_status'   => $this->invoiceStatusMapping[$invoiceResult['invoiceStatus']],   // PDFURL
                'sync'             => $this->syncMapping[$invoiceResult['invoiceStatus']],   // PDFURL
                'is_status'        => $this->isStatusMapping[$invoiceResult['invoiceStatus']],   // 开票状态
                'xml_url'          => $invoiceResult['xmlUrl'],   // XML URL
                'ofd_url'          => $invoiceResult['ofdUrl'],   // OFD URL
            );

        }

        // 可回传列表为空则直接返回
        if (!$data || empty($data)) {
            throw new exception('发票回传结果为空');
        }

        return $data;
    }
}
