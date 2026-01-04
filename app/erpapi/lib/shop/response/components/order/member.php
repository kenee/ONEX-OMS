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
* 订单会员
*
* @author chenping<chenping@shopex.cn>
* @version $Id: tax.php 2013-3-12 17:23Z
*/
class erpapi_shop_response_components_order_member extends erpapi_shop_response_components_order_abstract
{
    /**
     * convert
     * @return mixed 返回值
     */

    public function convert()
    {
        $member_info = $this->_platform->_ordersdf['member_info'];
        $shop_id     = $this->_platform->__channelObj->channel['shop_id'];

        unset($member_info['member_id']);
        if ($member_info) {
            $member_info['shop_type'] = $this->_platform->__channelObj->channel['shop_type'];
            $member_info['consignee'] = $this->_platform->_ordersdf['consignee'];
            $member_id = kernel::single('ome_member_func')->save($member_info,$shop_id);
            if ($member_id) {
                $this->_platform->_newOrder['member_id'] = $member_id;
                
                
            }

        }
    }
    
    /**
     * 更新
     * @return mixed 返回值
     */
    public function update()
    {
        $member_info = $this->_platform->_ordersdf['member_info'];
        $shop_id     = $this->_platform->__channelObj->channel['shop_id'];

        unset($member_info['member_id']);

        if ($member_info) {
            $member_id = kernel::single('ome_member_func')->save(
                $member_info,
                $shop_id,
                $this->_platform->_tgOrder['member_id'],
                $old_member
                );

            if ($member_id != $this->_platform->_tgOrder['member_id']) {
                $this->_platform->_newOrder['member_id'] = $member_id;
            }
        }
    }
}