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
 * @author ykm 2015-12-16
 * @describe 发起电子面单请求
 */
class brush_electron_ems extends brush_electron_abstract{

    /**
     * 回填发货信息
     */
    public function delivery() {
        $shop = $this->getChannelExtend();
        foreach($this->delivery as $delivery) {
            $sdf = array();
            $sdf['delivery'] = $delivery;
            $sdf['shop'] = $shop;
            $this->request('delivery', $sdf);
        }
    }

    public function deliveryToSdf($delivery) {//各自实现
        $sdf = array();

        return $sdf;
    }
}