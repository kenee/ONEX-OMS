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


class eccommon_ctl_admin_analysis extends desktop_controller
{

    /**
     * chart_view
     * @return mixed 返回值
     */
    public function chart_view()
    {
         $show = $_GET['show'];

         //todo 这里需要根据不同的需求读取数据
         if($_GET['callback']){
             $data = kernel::single($_GET['callback'])->fetch_graph_data($_GET);
         }else{
             $data = kernel::single('eccommon_analysis_base')->fetch_graph_data($_GET);
         }

         $this->pagedata['categories']='["' . @join('","', $data['categories']) . '"]';
         $tmp = [];
         foreach($data['data'] AS $key=>$val){
             $tmp[] = '{name:"'.addslashes($key).'",data:['.@join(',', $val).']}';
         }
         $this->pagedata['data'] = '['.@join(',', $tmp).']';

         switch($show){
            case 'line':
                $this->display("analysis/chart_type_line.html");
                break;
            case 'column':
                $this->display("analysis/chart_type_column.html");
                break;
            default :
                $this->display("analysis/chart_type_default.html");
                break;
        }
    }//End Function

}//End Class