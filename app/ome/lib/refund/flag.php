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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2022/9/19 15:09:41
 * @describe: 类
 * ============================
 */
class ome_refund_flag {
    private $flag = [
        1 => '拦截包裹',
        2 => '协商退货退款',
    ];

    /**
     * 更新
     * @param mixed $applyId ID
     * @param mixed $flagTxt flagTxt
     * @return mixed 返回值
     */

    public function update($applyId, $flagTxt) {
        if(empty($applyId)) {
            return [false, '参数不全'];
        }
        $mdlApply = app::get('ome')->model('refund_apply');
        $index = array_search($flagTxt, $this->flag);
        if($index === false) {
            return [false, '没有该标识'];
        }
        $row = $mdlApply->db_dump($applyId, 'flag');
        $flagArr = explode(',', $row['flag']);
        if(in_array($index, $flagArr)) {
            return [true, '已经存在'];
        }
        $mdlApply->update(['flag'=>$row['flag'].','.$index], ['apply_id'=>$applyId]);
        return [true, '更新成功'];
    }

    /**
     * 获取FlagTxt
     * @param mixed $flag flag
     * @return mixed 返回结果
     */
    public function getFlagTxt($flag) {
        $flagArr = explode(',', $flag);
        $return = [];
        foreach ($flagArr as $v) {
            if($this->flag[$v]) $return[] = $this->flag[$v];
        }
        return implode(',', $return);
    }
}