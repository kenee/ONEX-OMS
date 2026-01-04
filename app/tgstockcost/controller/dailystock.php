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

class tgstockcost_ctl_dailystock extends desktop_controller
{

    public $workground = "invoice_center";

    /**
     * index
     * @return mixed 返回值
     */
    public function index()
    {
        $baseFilter = [];
        if (!isset($_POST['stock_date'])) {
            $baseFilter['stock_date'] = date('Y-m-d',strtotime('-1 days'));
        }
        $date = $baseFilter['stock_date'] ? $baseFilter['stock_date'] : $_POST['stock_date'];

        $this->finder('tgstockcost_mdl_dailystock', array(
            'title'                  => '进销存统计'.'<em class="c-red">默认显示 '.$date.' 数据</em>',
            'use_buildin_new_dialog' => false,
            'use_buildin_set_tag'    => false,
            'use_buildin_recycle'    => false,
            'use_buildin_export'     => true,
            'use_buildin_import'     => false,
            'use_buildin_filter'     => true,
            'use_buildin_setcol'     => false,
            'base_filter' => $baseFilter,
            'orderBy' => 'id desc',
        ));
    }
}
