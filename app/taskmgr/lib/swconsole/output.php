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
 * 命令行输出
 * Class OutPut
 */
class taskmgr_swconsole_output
{
    private static $outFile = null;

    /**
     * 设置输出文件
     * @param $outFile
     */

    public static function setOutFile($outFile = null)
    {
        self::$outFile = $outFile;
    }

    /**
     * 正常输出
     * @param string $content
     * @param int $len
     */
    public static function normal(string $content, $len = 0)
    {
        taskmgr_swconsole_format::setContent(self::center($content, $len))->setOutFile(self::$outFile)->outPut();
    }

    /**
     * 信息输出
     * @param string $content
     * @param int $len
     */
    public static function info(string $content, $len = 0)
    {
        taskmgr_swconsole_format::setContent(self::center($content, $len))->setOutFile(self::$outFile)->color(0, 255, 0)->outPut();
    }

    /**
     * 警告输出
     * @param string $content
     * @param int $len
     */
    public static function warning(string $content, $len = 0)
    {
        taskmgr_swconsole_format::setContent(self::center($content, $len))->setOutFile(self::$outFile)->color(255, 230, 0)->outPut();
    }

    /**
     * 错误输出
     * @param string $content
     * @param int $len
     */
    public static function error(string $content, $len = 0)
    {
        taskmgr_swconsole_format::setContent(self::center($content, $len))->setOutFile(self::$outFile)->color(255, 0, 0)->outPut();
    }

    /**
     * 内容居中（两侧填充空格）
     * @param string $content
     * @param int $len 需要为偶数
     * @return string
     */
    public static function center(string $content, $len = 0)
    {
        $newStr = preg_replace('/[^\x{4e00}-\x{9fa5}]/u', '', $content);
        $mbLen  = mb_strlen($newStr, "utf-8");
        $strLen = mb_strlen($content) + $mbLen;
        if ($len > 0 && $strLen % 2 != 0) {
            $content = ' ' . $content;
            $strLen++;
        }
        $n = ($len - $strLen) / 2;
        if ($strLen < $len) {
            for ($i = 0; $i < $n; $i++) {
                $content = ' ' . $content . ' ';
            }
        }
        return $content;
    }

}
