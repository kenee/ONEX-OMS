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

class erpapi_ipay_request_bill extends erpapi_ipay_request_abstract
{
    protected function __getQueryApi($sdf)
    {
        $node_type = $sdf['node_type'] ?? '';
        switch ($node_type) {
            case 'luban':
                $api_method = STORE_DOWNLOAD_SHOP_ACCOUNT_ITEM;
                break;
            default :
                $api_method = SHOP_QIANBAO_BILL_DETAIL_QUERY;
                break;
        }
        return $api_method;
    }
    
    /**
     * query
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function query($sdf)
    {
        return $this->__caller->call($this->__getQueryApi($sdf), $sdf, array (), '拉取账单',10,$this->__channelObj->channel['channel_bn']);
    }
    
    protected function __getDownloadurlApi($sdf)
    {
        $node_type = $sdf['node_type'] ?? '';
        switch ($node_type) {
            case 'luban':
                $api_method = STORE_DOWNLOAD_SHOP_ACCOUNT_ITEM_FILE;
                break;
            default :
                $api_method = SHOP_ALIPAY_BILL_GET;
                break;
        }
        return $api_method;
    }

    /**
     * downloadurl
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function downloadurl($sdf)
    {
    	return $this->__caller->call($this->__getDownloadurlApi($sdf), $sdf, array (), '下载账单URL',10,$this->__channelObj->channel['channel_bn']);
    }
}