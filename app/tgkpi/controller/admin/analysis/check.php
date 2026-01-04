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

class tgkpi_ctl_admin_analysis_check extends desktop_controller{

    /**
     * @description 图表显示员工当日捡货绩效
     * @access public
     * @param String $chart 图表类型
     * @return void
     */
    public function showCharts($chart='column')
    {
        $this->pagedata['title'] = '当日员工校验绩效';
        $this->pagedata['chart'] = $chart;

        $this->singlepage('admin/analysis/checkCharts.html','tgkpi');
    }

    /**
     * @description
     * @access public
     * @param void
     * @return void
     */
    public function ajaxChartData()
    {
        $post = $_POST;
        if (!isset($post['start_time']) && !isset($post['end_time'])) {
            $post['start_time'] =  strtotime(date('Y-m-d'));
            $post['end_time'] = $post['start_time']+86400;
        }
        $chartData = $this->app->model('pick')->getCheckChartData($post);
        echo json_encode($chartData);exit;
    }

}