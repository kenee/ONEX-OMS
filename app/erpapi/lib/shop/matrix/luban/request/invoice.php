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
/**
 * @Author: xueding@shopex.cn
 * @Date: 2023/4/11
 * @Describe: 抖音发票处理
 */
class erpapi_shop_matrix_luban_request_invoice extends erpapi_shop_request_invoice
{
    /**
     * 获取发票信息参数重组
     * @Author: xueding
     * @Vsersion: 2023/4/11 下午5:26
     * @param $params
     * @return array
     */

    public function getApplyInfoFormat($params)
    {
        $sdf = array(
            'start_time'   => $params['start_time'],
            'end_time'     => $params['end_time'],
            'tid'          => $params['order_bn'],
            'status'       => $params['status'],
            'order_by'     => $params['order_by'],
            'page'         => $params['page'],
            'size'         => $params['size'],
            'platform_tid' => 'getInvoiceList-'.$this->__channelObj->channel['name'],
        );
        return $sdf;
    }
    
    public function getApplyInfoApiname()
    {
        return SHOP_INVOICE_QUERY;
    }
    
    protected function getUploadParams($sdf)
    {
        $invoice    = $sdf['invoice'];
        $electronic = $sdf['electronic'];
        
        $params = array(
            'tid'         => $invoice['order_bn'], # 订单编号 必须
            'upload_file' => $electronic['url'],    # 文件   必须
        );
        
        return $params;
    }
    
    /**
     * 获取UploadApiname
     * @return mixed 返回结果
     */
    public function getUploadApiname()
    {
        return SHOP_INVOICE_STATUS_UPDATE;
    }
}
