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

class logisticsaccounts_estimate_delivery extends eccommon_analysis_abstract implements eccommon_analysis_interface{
    public $type_options = array(
        'display' => 'true',
    );


    public $graph_options = array(
        'hidden' => true,
    );


    /**
     * ext_detail
     * @param mixed $detail detail
     * @return mixed 返回值
     */
    public function ext_detail(&$detail){
        $filter = $this->_params;


    }

    /**
     * 查找er
     * @return mixed 返回结果
     */
    public function finder(){
        return array(
            'model' => 'logisticsaccounts_mdl_estimate',
            'params' => array(
                'actions'=>array(
                    array(
                        'label'=>app::get('logisticsaccounts')->_('获取数据'),

                        'href'=>'index.php?app=logisticsaccounts&ctl=admin_estimate&act=import'),
                ),
                'title'=>app::get('logisticsaccounts')->_('预估单'),
                'use_buildin_recycle'=>false,
                'use_buildin_selectrow'=>false,
                'use_view_tab'=>true,
            ),
        );
    }
}