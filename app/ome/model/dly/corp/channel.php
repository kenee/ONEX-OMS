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

class ome_mdl_dly_corp_channel extends dbeav_model{

    /**
     * @param $corp array(corp_id,channel_id)
     * @param $dly array(array(shop_id))
     * @return void
     */
    public function getChannel(&$corp, $dly) {
        if(empty($corp['channel_id'])) {
            return null;
        }
        $rows = $this->getList('*', array('corp_id'=>$corp['corp_id']));
        if($rows) {
            $shopTypeChannel = array();
            foreach ($rows as $val) {
                $shopTypeChannel[$val['shop_type']] = $val;
            }
            $shop = app::get('ome')->model('shop')->getList('shop_id,shop_type', array('shop_type'=>array_keys($shopTypeChannel)));
            $shopTypeId = array();
            $shopId = array();
            foreach ($shop as $val) {
                $shopTypeId[$val['shop_type']][] = $val['shop_id'];
                $shopId[] = $val['shop_id'];
            }
            $channel = '';
            foreach ($dly as $d) {
                if(in_array($d['shop_id'], $shopId)) {
                    foreach ($shopTypeId as $k => $s) {
                        if(in_array($d['shop_id'], $s)) {
                            if($channel) {
                                if($channel != $shopTypeChannel[$k]) {
                                    $corp['channel_id'] = '';
                                    return null;
                                }
                            } else {
                                $channel = $shopTypeChannel[$k];
                            }
                            break;
                        }
                    }
                } else {
                    if($channel) {
                        if($channel != $corp) {
                            $corp['channel_id'] = '';
                            return null;
                        }
                    } else {
                        $channel = $corp;
                    }
                }
            }
            if($channel) {
                $corp['channel_id'] = $channel['channel_id'];
                $corp['prt_tmpl_id'] = $channel['prt_tmpl_id'];
            }
        }
    }
}