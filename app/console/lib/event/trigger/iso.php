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

class console_event_trigger_iso
{
    /**
     * 查询出入单结果
     *
     * @return void
     * @author
     **/
    public function search($iso_id)
    {
        $iso = app::get('taoguaniostockorder')->model("iso")->db_dump($iso_id);

        $wms_id = kernel::single('ome_branch')->getWmsIdById($iso['branch_id']);

        $data = array(
            'out_order_code' => $iso['out_iso_bn'],
            'stockin_bn'     => $iso['iso_bn'],
        );

        $io = kernel::single('siso_receipt_iostock')->getIoByType($iso['type_id']);

        if ($io){
            return kernel::single('console_event_trigger_otherstockin')->search($wms_id, $data);
        } else {
            return kernel::single('console_event_trigger_otherstockout')->search($wms_id, $data);
        }
    }
}
