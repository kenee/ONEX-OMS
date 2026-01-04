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
abstract class erpapi_yilianyun_request_abstract
{
    protected $default_channel = 'yilianyun';

    /**
     * 渠道
     *
     * @var string
     **/
    protected $__channelObj;

    protected $__resultObj;

    /**
     * 初始化
     * @param erpapi_channel_abstract $channel channel
     * @param erpapi_config $config 配置
     * @param erpapi_result $result result
     * @return mixed 返回值
     */
    final public function init(erpapi_channel_abstract $channel, erpapi_config $config, erpapi_result $result)
    {
        $this->__channelObj = $channel;

        $this->__resultObj = $result;

        // 默认以JSON格式返回
        $this->__caller = kernel::single('erpapi_caller', array('uniqid' => uniqid('yilianyun')))
            ->set_config($config)
            ->set_result($result);
    }

    /**
     * succ
     * @param mixed $msg msg
     * @param mixed $msgcode msgcode
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    final public function succ($msg = '', $msgcode = '', $data = null)
    {
        return array('rsp' => 'succ', 'msg' => $msg, 'code' => $msgcode, 'data' => $data);
    }

    /**
     * error
     * @param mixed $msg msg
     * @param mixed $msgcode msgcode
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    final public function error($msg, $msgcode = '', $data = null)
    {
        return array('rsp' => 'fail', 'msg' => $msg, 'err_msg' => $msg, 'code' => $msgcode, 'data' => $data);
    }

    /**
     * 回调
     * @param $response Array
     * @param $callback_params Array
     * @return array
     **/
    public function callback($response, $callback_params)
    {
        return $response;
    }
}