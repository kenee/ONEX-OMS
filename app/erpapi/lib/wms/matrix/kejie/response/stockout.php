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
 * 出库单
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_matrix_kejie_response_stockout extends erpapi_wms_response_stockout
{    
    /**
     * wms.stockout.status_update
     *
     **/

    public function status_update($params){
        $params = parent::status_update($params);
        if (!$params['items'] && $params['io_status'] == 'FINISH'){
            $params['items'] = $this->_format_items($params);
        }
        return $params;
    }

    
    private function _format_items($params){
        $rp_itemObj = app::get('purchase')->model('returned_purchase_items');
        if ($params['io_type'] == 'PURCHASE_RETURN'){

            
            $items = $rp_itemObj->db->select("SELECT i.bn,i.num FROM sdb_purchase_returned_purchase as p LEFT JOIN sdb_purchase_returned_purchase_items as i ON p.rp_id=i.rp_id WHERE p.rp_bn='".$params['io_bn']."'");
        }else{
            $items = $rp_itemObj->db->select("SELECT i.bn,i.nums as num FROM sdb_taoguaniostockorder_iso as iso LEFT JOIN sdb_taoguaniostockorder_iso_items as i ON iso.iso_id=i.iso_id WHERE iso.iso_bn='".$params['io_bn']."'");
        }
        if ($items){
            return $items;
        }
    }
}
