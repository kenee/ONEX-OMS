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
abstract class erpapi_wms_response_abstract
{
    protected $__channelObj;

    public $__apilog;

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

    protected function getOmsProductBn($wms_id,$arrbn){

        $sku = app::get('console')->model('foreign_sku')->getList('inner_product_id,inner_sku,oms_sku', array('wms_id' => $wms_id, 'oms_sku' => $arrbn));
        $omsProductBn = array();
        foreach ($sku as $val) {
            if($val['oms_sku']){
                $omsProductBn[$val['oms_sku']] = $val['inner_sku'];
            }
            
        }


        return $omsProductBn;
    }
}
