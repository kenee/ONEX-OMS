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
 * Created by PhpStorm.
 * User: sqs
 * Date: 2022/7/15
 * Time: 6:05 PM
 */
class erpapi_yilianyun_request_comm extends erpapi_yilianyun_request_abstract
{
    /**
     * 自有型应用获取accessToken
     * @return void
     */

    public function oauth($appInfo)
    {
        
        base_kvstore::instance('yilianyun/oauth/token')->fetch($appInfo['org_bn'], $response);
       
        # 是否重新获取accessToken
        $retry_get_accesstoken = true;

        if (!empty($response) && !$appInfo['force_again']) {
            $token_expirtime = empty($response['expires_time']) ? time() : $response['expires_time'];
            if (time() - $token_expirtime < 0) {
               //$retry_get_accesstoken = false;
            }
            $response = ['rsp' => 'succ', 'data' => $response, 'res' => $response];
        }

        # 重新获取accessToken
        if ($retry_get_accesstoken) {
            $params = [
                'grant_type' => 'client_credentials',  // 默认值client_credentials
                'scope' => 'all',  //权限范围，默认值all
                'temp' => [
                    'client_id' => $appInfo['app_key'],
                    'client_secret' => $appInfo['app_secret'],
                ],
            ];

            $title = '获取易连云打印机AccessToken';
            $this->__original_bn = $appInfo['delivery_bn'];
            $callback = array();

            $response = $this->__caller->call(YLY_OAUTH_OAUTH, $params, $callback, $title, 30, $this->__original_bn);

            if ($response['rsp'] == 'succ') {
                # 数据转换
                if (empty($response['res'])) {
                    $new_response = json_decode($response['response'], true);
                    if (!empty($new_response['body'])) {
                        $response['res'] = $new_response['body'];
                        $response['data'] = $new_response['body'];
                    }
                }
                if (empty($response['res'])) {
                    $response['rsp'] = 'fail';
                    $response['msg'] = '获取AccessToken失败';
                    return $response;
                }

                # 保存新的accessToken
                $sessData = [
                    'access_token' => $response['res']['access_token'],
                    'refresh_token' => $response['res']['refresh_token'],
                    'machine_code' => $response['res']['machine_code'],
                    'expires_time' => time() + $response['res']['expires_in'],
                    'refresh_expires_time' => time() + $response['res']['refresh_expires_in'],
                ];
                base_kvstore::instance('yilianyun/oauth/token')->store($appInfo['org_bn'], $sessData);
            }
        }
        return $response;
    }
}