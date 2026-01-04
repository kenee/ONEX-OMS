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
 * RESULT DEAL
 *
 * @category 
 * @package 
 * @author yaokangming<yaokangming@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_openapi_sku360_result extends erpapi_result
{
    function set_response($resp, $format){
        $tmpResponse = kernel::single('erpapi_format_'.$format)->data_decode($resp);
        if($tmpResponse['success'] === true) {
            $response['rsp'] = 'succ';
            if($tmpResponse['msg']) {
                $response['err_msg'] = $tmpResponse['msg'];
            } elseif(isset($tmpResponse['errors'])) {
                $response['err_msg'] = '推送成功';
            }
        } elseif($tmpResponse['success'] === false) {
            $response['rsp'] = 'fail';
            if($tmpResponse['msg']) {
                $response['err_msg'] = $tmpResponse['msg'];
            } elseif(isset($tmpResponse['errors'])) {
                $response['err_msg'] = '推送失败';
                $response['data'] = $tmpResponse['errors'];
                $res = '';
                foreach($tmpResponse['errors'] as $key => $val){
                    $res = $val['purchase_code'] . ':' . $val['reason'] . ', ';
                }
                $response['res'] = $res;
            }
        } else {
            $response['err_msg'] = $resp;
            $response['rsp'] = 'fail';
        }
        $this->response = $response;

        return $this;
    }
}