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

declare(strict_types=1);

/**
 * 库存冻结异常
 *
 */
namespace Shopex\OMS\ome\exception;

class BranchStoreFreezeException extends \Exception
{
    protected $additionalInfo;

    /**
     * __construct
     * @param mixed $message message
     * @param mixed $code code
     * @param Exception $previous previous
     * @param mixed $additionalInfo additionalInfo
     * @return mixed 返回值
     */
    public function __construct($message, $code = 0, \Exception $previous = null, $additionalInfo = [])
    {
        parent::__construct($message, $code, $previous);

        $this->additionalInfo = $additionalInfo;
    }

    /**
     * 获取AdditionalInfo
     * @return mixed 返回结果
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n"
             . ($this->additionalInfo ? "\nAdditional Info: " . json_encode($this->additionalInfo, JSON_UNESCAPED_UNICODE) : '');
    }
}
