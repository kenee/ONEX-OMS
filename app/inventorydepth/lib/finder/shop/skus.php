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

class inventorydepth_finder_shop_skus {

    public $addon_cols = 'mapping,simple,shop_iid,shop_id';
    function __construct($app)
    {
        $this->app = $app;
    }

    public $column_operator = '操作';
    public $column_operator_order = 1;
    public $column_operator_width = '200px;';
    public function column_operator($row)
    {
        if ($row['request'] == 'true') {
            $request_name = $this->app->_('关闭回写');
            $request_url = 'index.php?app=inventorydepth&ctl=shop_skus&act=set_request&p[0]=false&p[1]='.$row['id'].'&finder_id='.$_GET['_finder']['finder_id'];
        }else{
            $request_name = $this->app->_('开启回写');
            $request_url = 'index.php?app=inventorydepth&ctl=shop_skus&act=set_request&p[0]=true&p[1]='.$row['id'].'&finder_id='.$_GET['_finder']['finder_id'];
        }

        $return = <<<EOF
        <a href='{$request_url}' >{$request_name}</a>
EOF;
        /*
        if ($row['request_frame'] == 'true') {
            $request_name = $this->app->_('关闭自动上下架');
            $request_url = 'index.php?app=inventorydepth&ctl=shop_skus&act=set_frame&p[0]=false&p[1]='.$row['id'].'&finder_id='.$_GET['_finder']['finder_id'];
        }else{
            $request_name = $this->app->_('开启自动上下架');
            $request_url = 'index.php?app=inventorydepth&ctl=shop_skus&act=set_frame&p[0]=true&p[1]='.$row['id'].'&finder_id='.$_GET['_finder']['finder_id'];
        }

        $return .= <<<EOF
        <a href='{$request_url}'>{$request_name}</a>
EOF;
        */

        if ($row[$this->col_prefix.'mapping'] == 0) {
            $shop = app::get('ome')->model('shop')->db_dump(['shop_id'=>$row[$this->col_prefix.'shop_id']], 'node_type, business_type');
            if($shop['node_type'] == 'taobao' && $shop['business_type'] != 'maochao') {
                if ($row[$this->col_prefix.'simple'] == 'true') {
                    $id = $this->app->model('shop_items')->select()->columns('id')
                            ->where('iid=?',$row[$this->col_prefix.'shop_iid'])
                            ->where('shop_id=?',$row[$this->col_prefix.'shop_id'])
                            ->instance()->fetch_one();

                    $return .= <<<EOF
                    <a href='index.php?app=inventorydepth&ctl=shop&act=download_page&id={$id}&downloadType=iid' target="dialog::{title:'同步货品【{$row["shop_product_bn"]}】'}">同步商品</a>
EOF;
                } else {
                    $return .= <<<EOF
                    <a href='index.php?app=inventorydepth&ctl=shop&act=download_page&id={$row["id"]}&downloadType=sku_id' target="dialog::{title:'同步货品【{$row["shop_product_bn"]}】'}">同步商品</a>
EOF;
                }
            }
        }
        return $return;
    }


}
