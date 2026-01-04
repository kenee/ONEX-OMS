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
 * @Vsersion: 2022/10/18
 * @Describe: 预警通知邮件发送
 */
class monitor_event_trigger_notify_common
{
    private $__send_type;

    public function set_send_type($send_type)
    {
        $this->__send_type = $send_type;

        return $this;
    }

    public function send($notifyInfo)
    {
        return ['rsp' => 'fail', 'msg' => ''];

    }

    final protected function curl($url, $postFields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        if (is_array($headers) && 0 < count($headers)) {
            $http_header = array();
            foreach ($headers as $k => $v) {
                $http_header[] = $k . ':' . implode(',', (array) $v);
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        $response = curl_exec($ch);

        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch), $httpStatusCode);
        } else {
            if (200 !== $httpStatusCode) {
                throw new Exception($response, $httpStatusCode);
            }
        }

        curl_close($ch);

        return $response;
    }
}
