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
 * @author ykm 2019/4/22
 * @describe 待寻仓订单数据验证
 */

class erpapi_shop_response_params_branch extends erpapi_validate {

    protected function wait() {
        $params = array(
            'available_warehouses' => array('type'=>'string','required'=>'true','errmsg'=>'可用仓库必填'),
            'items' => array('type'=>'array','required'=>'true','errmsg'=>'明细必填'),
        );
        return $params;
    }
}