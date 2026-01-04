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
* 费用项模型类
* @author 334395174@qq.com
* @version 0.1
*/
class financebase_mdl_bill_fee_type extends dbeav_model
{

    /**
     * modifier_bill_type
     * @param mixed $val val
     * @return mixed 返回值
     */

    public function modifier_bill_type($val)
    {
        return $val ? '支出' : '收入';
    }

}