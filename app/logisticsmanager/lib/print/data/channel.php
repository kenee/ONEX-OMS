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
 * @author ykm 2015-12-25
 * @describe channel打印数据整理
 */
class logisticsmanager_print_data_channel{

    /**
     * channel
     * @param mixed $oriData ID
     * @param mixed $corp corp
     * @param mixed $field field
     * @param mixed $type type
     * @return mixed 返回值
     */

    public function channel(&$oriData, $corp, $field, $type) {
        $pre = __FUNCTION__ . '.';
        if(array_intersect(array('sfproduct_type','jdcustomer_code'),$field)) {
            $channelModel = app::get('logisticsmanager')->model('channel');
            $channelData = $channelModel->dump(array('channel_id'=>$corp['channel_id']),'logistics_code,shop_id,channel_type');
        }

        $channelExModel = app::get('logisticsmanager')->model('channel_extend');
        $channelEx = $channelExModel->dump(array('channel_id'=>$corp['channel_id']),'seller_id');
        $channel = $channelEx ? ($channelData ? array_merge($channelEx, $channelData) : $channelEx) : $channelData;
        foreach($oriData as $key => $value) {
            foreach($field as $f) {
                if(isset($channel[$f])) {
                    $oriData[$key][$pre . $f] = $channel[$f];
                } elseif(method_exists($this, $f)) {
                    $oriData[$key][$pre . $f] = $this->$f($channel);
                } else {
                    $oriData[$key][$pre . $f] = '';
                }
            }
        }
    }

    private function sfproduct_type($channel) {
        $obj = kernel::single('logisticsmanager_waybill_sf');
        $logisticsType = $obj->logistics($channel['logistics_code']);
        return $logisticsType['name'] ? $logisticsType['name'] : '';
    }

    /**
     * summary
     * 
     * @return void
     * @author 
     */
    private function jdcustomer_code($channel)
    {
        if ($channel['channel_type'] == '360buy') {
            list($jdcustomer_code,$shop_id) = explode('|||',$channel['shop_id']);

            return $jdcustomer_code;
        }

        return '';
    }
}