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
 * 商品上架处理类
 *
 * @author chenping<chenping@shopex.cn>
 */

class inventorydepth_frame {
    const PUBL_LIMIT = 100;
    const SYNC_LIMIT = 50;
    const PUBL_TIME = 1440;//距离上次成功发布的发布间隔 单位 分钟

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function get_benchmark($key)
    {
        $return = array(
                'upper' => '上架',
                'lower' => '下架',
            );

        return $key ? $return[$key] : $return;
    }

    public function sku_option($key)
    {
        $return = array(
            'each' => '全部货品',
            'some' => '某一货品',
        );

        return $key ? $return[$key] : $return;
    }

}
