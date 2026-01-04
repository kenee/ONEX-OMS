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
 * 预定义的场景和元素
 * Class ome_reship_setting
 */
class ome_reship_setting
{
    /**
     * 获取_pagecols_setting
     * @param mixed $type type
     * @return mixed 返回结果
     */

    public function get_pagecols_setting($type = '')
    {
        $predefinedScenes = array(
            'ome_reship' => array(
                'name'     => '新建退换货单',
                'elements' => array(
                    'flag_type' => array(
                        'name' => '售后类型',
                        'options' => array(
                            'kt' => '客退',
                            'ydt' => '原单退',
                        ),
                        'default' => 'kt'
                    ),
                    'return_logi_name' => array(
                        'name' => '退回物流公司',
                        'options' => array(),
                        'default' => ''
                    ),
                    'return_logi_no' => array(
                        'name' => '退货物流单号',
                        'options' => array(),
                        'default' => ''
                    ),
                )
            ),
        );
        return $predefinedScenes[$type] ?? $predefinedScenes;
    }
}