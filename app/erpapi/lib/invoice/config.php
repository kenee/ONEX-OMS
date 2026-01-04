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
 * 发票接口配置类
 *
 * @author xiayuanjun<xiayuanjun@shopex.cn>
 * @version 0.1
 */
class erpapi_invoice_config extends erpapi_config
{
    /**
     * 应用级参数
     *
     * @param String $method 请求方法
     * @param Array $params 业务级请求参数
     * @return void
     * @author 
     **/

    public function get_query_params($method, $params){
        $query_params = array(
            'app_id'       => 'ecos.ome',
            'method'       => $method,
            'date'         => date('Y-m-d H:i:s'),
            'format'       => 'json',
            'certi_id'     => base_certificate::certi_id(),
            'v'            => '1',
            'from_node_id' => base_shopnode::node_id('ome'),
            'to_node_id'   => $this->__channelObj->channel['node_id'],
            'node_type'    => $this->__channelObj->channel['node_type'] ? $this->__channelObj->channel['node_type'] : $this->__channelObj->channel['channel_type'],
        );
        if ($this->__channelObj->channel['golden_tax_version'] == '0' && $this->__channelObj->channel['channel_type'] == 'baiwang') {
            $query_params['invoiceTerminalCode'] = '410123456732';
        }
        //矩阵区分金三接口还是金四接口
        if (isset($this->__channelObj->channel['golden_tax_version'])) {
            $query_params['golden_tax_version'] = $this->__channelObj->channel['golden_tax_version'];
        }
        return $query_params;
    }
    
    private $__global_whitelist = array(
        EINVOICE_CREATEREQ,
        EINVOICE_CREATE_RESULT_GET,
        EINVOICE_DETAIL_UPLOAD,
        EINVOICE_URL_GET,
        EINVOICE_INVOICE_GET,
        EINVOICE_INVOICE_PREPARE,
        STORE_JINSHUI_INVOICE_FILE_CREATE,
        STORE_JINSHUI_INVOICE_QUERY,
        STORE_JINSHUI_INVOICE_RESULT_QUERY,
        STORE_BW_INVOICE_REQUEST,
        STORE_BW_INVOICE_FILE_GET,
        STORE_BW_INVOICE_FILE_CREATE,
        STORE_INVOICE_ISSUE,
    );

}