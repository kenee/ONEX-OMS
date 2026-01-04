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
 * @DateTime: 2020/11/25 11:06:02
 * @describe: 按体积权重费用拆分
 * ============================
 */
class financebase_expenses_sku_volume extends financebase_expenses_sku_abstract {
    protected $failMsg = 'sku长宽高缺失'; //失败原因

    protected function _getPorthValue($skuList) {
        $bmIds = array();
        $bmNum = array();
        foreach ($skuList['sku'] as $v) {
            $bmIds[] = $v['bm_id'];
            $bmNum[$v['bm_id']] = $v['nums'];
        }
        $bmExt = app::get('material')->model('basic_material_ext')->getList('bm_id,length,width,high', array('bm_id'=>$bmIds));
        $porth = array();
        foreach ($bmExt as $v) {
            $volume = $v['length'] * $v['width'] * $v['high'];
            if($volume) {
                $porth[$v['bm_id']] = bcmul($volume, $bmNum[$v['bm_id']], 2);
            }
        }
        return $porth;
    }
}