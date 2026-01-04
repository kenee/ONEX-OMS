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
 * 流水单类
 *
 * @author 334395174@qq.com
 * @version 0.1
 */

class financebase_data_bill 
{

    /**
     * 根据平台获取未匹配订单号的数量
     */
    public function getUnMatchCountByOrderBn()
    {
        $oFunc = kernel::single('financebase_func');
        $mdlBill = app::get('financebase')->model('bill');

        $platform_list = $oFunc->getShopPlatform();

        $sql = "select count(*) as count,platform_type from `sdb_financebase_bill` where status = 0 group by `platform_type`";

        $list = $mdlBill->db->select($sql);

        foreach ($list as $k => $v) 
        {
            if(isset($platform_list[$v['platform_type']]))
            {
                $list[$k]['platform_name'] = $platform_list[$v['platform_type']];
            }
            else
            {
                unset($list[$k]);
            }
        }
        return $list;
    }

    
}