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
 * 转储单推送
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_openapi_cnss_request_stockdump extends erpapi_wms_request_stockdump
{
    protected function _format_stockdump_create_params($sdf)
    {
        $params = parent::_format_stockdump_create_params($sdf);

        $items = array('item'=>array());
        if ($sdf['items']){
            foreach ((array) $sdf['items'] as $k => $v){
                $barcode = kernel::single('material_codebase')->getBarcodeBybn($v['bn']);

                $items['item'][] = array(
                    'item_code'     => $barcode,
                    'item_name'     => $v['name'],
                    'item_quantity' => $v['num'],
                    'item_price'    => $v['price'] ? $v['price'] : '0',// TODO: 商品价格
                    'item_line_num' => ($k + 1),// TODO: 订单商品列表中商品的行项目编号，即第n行或第n个商品
                    'item_remark'   => '',// TODO: 商品备注
                );
            }
        }

        $params['items'] = json_encode($items);
        return $params;   
    }
}