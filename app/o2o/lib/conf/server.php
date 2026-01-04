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

class o2o_conf_server
{

    private static $__server = array(
        'wap'     => array(
            'label' => '系统自带移动端',
            'desc'  => '',
        ),
        'openapi' => array(
            'label' => '商派POS',
            'desc'  => '',
        ),
    );

    public static function getTypeList($type = '')
    {
        //判断是否配置阿里全渠道的主店铺和绑定奇门
        if (app::get('tbo2o')->is_installed()){
            $tbo2o_shop = kernel::single('tbo2o_common')->getTbo2oShopInfo();
            if (!empty($tbo2o_shop) && $tbo2o_shop["shop_id"]) {
                self::$__server["taobao"] = array(
                    'label' => '阿里全渠道',
                    'desc'  => '',
                );
            }
        }

        foreach (self::$__server as $key => $value) {
            $types[$key] = array('type' => $key, 'label' => $value['label'], 'desc' => $value['desc']);
        }
        return isset($types[$type]) ? $types[$type] : $types;
    }
}
