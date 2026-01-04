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

class tgstockcost_mdl_dailystock extends dbeav_model
{
    var $export_name = '进销存统计';
    //是否有导出配置
    var $has_export_cnf = true;
    
    /**
     * table_name
     * @param mixed $real real
     * @return mixed 返回值
     */
    public function table_name($real = false)
    {
        $table_name = 'dailystock';

        if ($real) {
            return kernel::database()->prefix . 'ome_' . $table_name;
        } else {
            return $table_name;
        }
    }

    /**
     * 获取_schema
     * @return mixed 返回结果
     */
    public function get_schema()
    {
        $schema = app::get('ome')->model('dailystock')->get_schema();

        return $schema;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function _filter($filter, $tableAlias = null, $baseWhere = null)
    {
        $where = " 1 ";
        //多基础物料查询
        if ($filter['product_bn'] && is_string($filter['product_bn']) && strpos($filter['product_bn'], "\n") !== false) {
            $filter['product_bn'] = array_unique(array_map('trim', array_filter(explode("\n", $filter['product_bn']))));
        }
        if ($filter['stock_date']) {
            $filter['stock_date'] = date('Y-m-d',strtotime($filter['stock_date']));
        }
        if ($filter['product_type']) {
            if(strpos($filter['product_type'], "\n") !== false){
                $filter['product_type'] = array_unique(array_map('trim', array_filter(explode("\n", $filter['product_type']))));
            }
            $nessoftMdl = app::get('nessoft')->model('products');
            $rows = $nessoftMdl->getList('local_product_code',array('product_type'=>$filter['product_type']));
            if ($rows) {
                $prodcutsBns = array_column($rows,'local_product_code');
                $where .= '  AND product_bn IN ("'.implode('","', $prodcutsBns).'")';
            }
            unset($filter['product_type']);
        }
        if ($filter['intnl_product_desc']) {
            $nessoftMdl = app::get('nessoft')->model('products');
            $rows = $nessoftMdl->getList('local_product_code',array('local_product_desc|has'=>$filter['intnl_product_desc']));
            if ($rows) {
                $prodcutsBns = array_column($rows,'local_product_code');
                $where .= '  AND product_bn IN ("'.implode('","', $prodcutsBns).'")';
            }
            unset($filter['intnl_product_desc']);
        }

        return $where ." AND ".parent::_filter($filter, $tableAlias, $baseWhere);
    }

    // function searchOptions(){
    //     $columns = parent::searchOptions();

    //     $columns['storage_code'] = '仓库库位';

    //     return $columns;
    // }
}
