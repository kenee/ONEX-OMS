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
 * 入库单
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_matrix_sf_response_stockin extends erpapi_wms_response_stockin
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/

    public function status_update($params)
    {
        $stockin_bn = $params['stockin_bn'];
        if ('MS' == substr($stockin_bn, 0, 2)) {
            return $this->convent_reship_params($params);    
        }

        return parent::status_update($params);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    private function convent_reship_params($params)
    {
        $reship = array(
            'logistics'    => '',
            'status'       => 'FINISH',
            'remark'       => '',
            'logi_no'      => '',
            'item'         => $params['item'],
            'reship_bn'    => substr(trim($params['stockin_bn']), 2),
            'warehouse'    => $params['warehouse'],
            'operate_time' => $params['operate_time'] ? $params['operate_time'] : date('Y-m-d H:i:s'),
        );

        $this->__apilog['title'] = $this->__channelObj->wms['channel_name'] . '退货单' . $reship['reship_bn'];
        $this->__apilog['original_bn'] = $reship['reship_bn'];

        $data = kernel::single('erpapi_wms_matrix_sf_response_reship')->init($this->__channelObj)->status_update($reship);

        // 为了过验证
        $data['io_bn'] = $params['stockin_bn'];

        return $data;
    }
}
