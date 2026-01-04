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
abstract class erpapi_qimen_response_abstract
{
    protected $__channelObj;

    public $__apilog;

    const MAX_LIMIT = 100;
    
    /**
     * 初始化
     * @param erpapi_channel_abstract $channel channel
     * @return mixed 返回值
     */
    public function init(erpapi_channel_abstract $channel)
    {
        $this->__channelObj = $channel;

        return $this;
    }
    
    /**
     * 去首尾空格
     *
     * @param Array
     * @return Array
     * @author
     **/
    public static function trim(&$arr)
    {
        foreach ($arr as $key => &$value) {
            if (is_array($value)) {
                self::trim($value);
            } elseif (is_string($value)) {
                $value = trim($value);
            }
        }
    }
    
    /**
     * 过滤空
     *
     * @return void
     * @author
     **/
    public function filter_null($var)
    {
        return !is_null($var) && $var !== '';
    }
    
    /**
     * qimen通过Body传输数据
     *
     * @param $params
     * @return void
     */
    public function _getResponseData($params)
    {
        // 获取数据
        if(isset($params['data'])){
            return $params['data'];
        }else{
            return $params;
        }
    }
}
