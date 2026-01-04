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

class ome_mdl_return_address extends dbeav_model
{
    //店铺类型
    /**
     * modifier_shop_type
     * @param mixed $row row
     * @return mixed 返回值
     */
    public function modifier_shop_type($row)
    {
        $shopTypeList = ome_shop_type::get_shop_type();
        
        return $shopTypeList[$row];
    }
    
    /**
     * 获取默认退货店址
     * @param   type    $varname    description
     * @return  type    description
     * @access  public
     * @author cyyr24@sina.cn
     */
    function getDefaultAddress($shop_id)
    {
        $address = $this->dump(array('shop_id'=>$shop_id,'cancel_def'=>'true'));
        $phone = explode('-',$address['phone']);#将电话处理一下
        $address['tel'] = $phone[0].$phone[1];
        $address['address'] = $address['province'].$address['city'].$address['country'].$address['addr'];
        return $address;
    }
}

?>