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
 * @DateTime: 2022/2/21 15:32:03
 * @describe: 网店门店关系
 * ============================
 */
class ome_shop_onoffline {

    /**
     * doSave
     * @param mixed $offline_id ID
     * @param mixed $online_id ID
     * @return mixed 返回值
     */

    public function doSave($offline_id, $online_id) {
        if(empty($offline_id)) {
            return [false, '参数不全'];
        }
        $onOff = app::get('ome')->model('shop_onoffline');
        $onOff->delete(['off_id'=>$offline_id]);
        if(empty($online_id) || !is_array($online_id)) {
            return [true];
        }
        $data = [];
        foreach ($online_id as $v) {
            $data[] = ['on_id'=>$v, 'off_id'=>$offline_id];
        }
        $sql = kernel::single('ome_func')->get_insert_sql($onOff, $data);
        $onOff->db->exec($sql);
        return [true];
    }
    
    /**
     * 前端店铺云店绑定
     * @param $online_shop_id string
     * @param $offline_shop_ids array
     * @return array
     * @date 2024-04-09 4:10 下午
     */
    public function onlineSave($online_shop_id, $offline_shop_ids)
    {
        if (!$online_shop_id) {
            return [false, '参数不全'];
        }
        $onOff = app::get('ome')->model('shop_onoffline');
        $onOff->delete(['on_id' => $online_shop_id]);
        
        if (empty($offline_shop_ids) || !is_array($offline_shop_ids)) {
            return [true, '保存成功'];
        }
        $data = [];
        foreach ($offline_shop_ids as $v) {
            $data[] = ['on_id' => $online_shop_id, 'off_id' => $v];
        }
        $sql = kernel::single('ome_func')->get_insert_sql($onOff, $data);
        $onOff->db->exec($sql);
        return [true, '保存成功'];
    }
}