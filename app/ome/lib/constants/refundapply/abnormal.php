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
 * 退款申请单异常标识
 */
class ome_constants_refundapply_abnormal
{

    #平台自发货
    const __NOPARTREFUND_CODE = 0x001;
    const __REPET_REFUND_CODE = 0x002;
    const __AG_NO_AUTO_REFUND = 0x004;

    private $status = array(
        self::__NOPARTREFUND_CODE => array('identifier' => '异', 'text' => '不支持部分退款', 'color' => '#fc2047', 'search' => 'true'),
        self::__REPET_REFUND_CODE => array('identifier'=>'拒', 'text'=>'售后仅退款触发AG拒绝', 'color'=>'orange', 'search'=>'true'),
        self::__AG_NO_AUTO_REFUND => array('identifier'=>'AG', 'text'=>'退货完成AG自动退款失败', 'color'=>'red', 'search'=>'true'),
    );

    /**
     * 获取Text
     * @param mixed $key key
     * @return mixed 返回结果
     */

    public function getText($key = null)
    {
        if ($key) {
            return (array) $this->status[$key];
        }

        return $this->status;
    }

    /**
     * 获取Identifier
     * @param mixed $s s
     * @return mixed 返回结果
     */
    public function getIdentifier($s)
    {
        $str = '';

        foreach ($this->status as $k => $v) {
            if ($s & $k) {
                $str .= sprintf("<span class='tag-label' title='%s' style='background-color:%s;color:#000000;'>%s</span>", $v['text'], $v['color'], $v['identifier']);
            }
        }

        return $str;
    }

    /**
     * 获取BoolType
     * @param mixed $filter filter
     * @return mixed 返回结果
     */
    public function getBoolType($filter)
    {
        $where = array();
        if ($filter['in']) {
            $in = 0;
            foreach ((array) $filter['in'] as $val) {
                $in = $in | $val;
            }
            $where[] = 'abnormal_status & ' . $in . ' = ' . $in;
        }
        if ($filter['out']) {
            $out = 0;
            foreach ((array) $filter['out'] as $val) {
                $out = $out | $val;
            }
            $where[] = '!(abnormal_status & ' . $out . ')';
        }
        if (empty($where)) {
            return array();
        }

        $sql  = 'select distinct abnormal_status from sdb_ome_refund_apply where ' . implode(' and ', $where);

        $rows = kernel::database()->select($sql);

        return $rows ? array_column($rows, 'abnormal_status') : ['-1'];
    }

    /**
     * 获取Options
     * @return mixed 返回结果
     */
    public function getOptions()
    {
        $options = array();
        foreach ($this->status as $k => $v) {
            if ($v['search'] == 'true') {
                $options[$k] = $v['text'];
            }
        }
        return $options;
    }
}
