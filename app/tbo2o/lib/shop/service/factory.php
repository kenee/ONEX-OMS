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
 * 店铺商品处理工厂类
 * 
 * @author wangbiao@shopex.cn
 * @version 0.1
 */
class tbo2o_shop_service_factory
{
    function __construct(&$app)
    {
        $this->app = $app;
    }
    
    /**
     * 工厂方法
     * @todo 只支持淘宝类型店铺
     *
     * @return void
     * @author 
     */
    public static function createFactory($shop_type, $business_type='zx')
    {
        switch ($shop_type)
        {
            case 'taobao':
                if ($business_type == 'fx')
                {
                    return kernel::single('tbo2o_shop_service_tbfx');
                }
                else
                {
                    return kernel::single('tbo2o_shop_service_taobao');
                }
                break;
            default:
                return false;
                break;
        }
    }
}