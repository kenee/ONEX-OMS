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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0
 * @DateTime: 2020/7/14 10:05:46
 * @describe: 拆单规则抽象类
 * ============================
 */
abstract class omeauto_split_abstract {

    #拆单规则配置获取数据
    abstract public function getSpecial();

    #拆单规则保存前处理 return array(true, '保存成功')
    abstract public function preSaveSdf(&$sdf);

    #拆分订单
    abstract public function splitOrder(&$group, $splitConfig);

    /**
     * splitOrderFromSplit
     * @param mixed $arrOrder arrOrder
     * @param mixed $group group
     * @param mixed $splitConfig 配置
     * @return mixed 返回值
     */

    public function splitOrderFromSplit(&$arrOrder, &$group, $splitConfig) {
        return array(true);
    }
}