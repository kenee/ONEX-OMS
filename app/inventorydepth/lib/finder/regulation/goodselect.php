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
 * @author chenping<chenping@shopex.cn>
 */

class inventorydepth_finder_regulation_goodselect {

    public $column_operator = '操作';
    public $column_operator_order = 1;
    public function column_operator($row)
    {
        $id = $row['id'];
        $init_bn = $_GET['init_bn'];
        $condition = $_GET['condition'];
        $finder_id = $_GET['_finder']['finder_id'];
        $url = "index.php?app=inventorydepth&ctl=regulation_apply&act=removeFilter&p[0]={$id}&p[1]={$init_bn}&p[2]={$condition}";
        $url .= '&finder_id='.$finder_id;
        
        $button = <<<EOF
        <a href='javascript:void(0);' onclick='
        if(confirm("确认要移除吗？")){
            W.page("{$url}",{
            });
            window.finderGroup["{$finder_id}"].refresh(true);
        }
        '>移除</a>
EOF;
        return $button;
    } 

}
