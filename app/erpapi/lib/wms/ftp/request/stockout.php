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
 * 出库单推送
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_ftp_request_stockout extends erpapi_wms_request_stockout
{

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/

    protected function transfer_stockout_type($io_type)
    {
        $stockout_type = array(
            'PURCHASE_RETURN' => 'H',// 采购退货
            'ALLCOATE'        => 'R',// 调拨出库
            'DEFECTIVE'       => 'B',// 残损出库
        );

        return $stockout_type[$io_type];
    }

    /**
     * 出库单创建
     *
     * @return void
     * @author 
     **/
    public function stockout_create($sdf){
        // 出库单号
        $io_bn = $sdf['io_bn'];

        $iscancel = kernel::single('console_service_commonstock')->iscancel($io_bn);
        if ($iscancel) {
            return $this->succ('出库单已取消,终止同步');
        }

        $items = array();
        foreach ((array) $sdf['items'] as $v){
            $barcode = kernel::single('material_codebase')->getBarcodeBybn($v['bn']);  // TODO:伊腾忠用条形码作唯一标识
            $items[] = array(
                'item_bn' => $barcode,
                'price'   => $v['price'],
                'num'     => $v['num'],
            );
        }

        $title = $this->__channelObj->wms['channel_name'] . '出库单添加';
        $params = array(
            'order_bn'  => $sdf['io_bn'],
            'warehouse' => $sdf['branch_bn'],
            'ship_name' => $sdf['receiver_name'],
            'province'  => $sdf['receiver_state'],
            'city'      => $sdf['receiver_city'],
            'district'  => $sdf['receiver_district'],
            'zip'       => $sdf['receiver_zip'],
            'addr'      => $sdf['receiver_address'],
            'phone'     => $sdf['receiver_phone'],
            'type'      => $this->transfer_stockout_type($sdf['io_type']),
            'items'     => json_encode($items),
        );

        return $this->__caller->call(WMS_OUTORDER_CREATE, $params, null, $title,10,$io_bn);
    } 

    /**
     * 出库单取消
     *
     * @return void
     * @author 
     **/
    public function stockout_cancel($sdf){
        return $this->error('接口方法不存在','w402');
    }

    public function stockout_search($sdf)
    {
        return $this->error('接口方法不存在','w402');
    }
}