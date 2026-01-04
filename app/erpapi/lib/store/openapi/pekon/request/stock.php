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
/**
 * pos发货单对接shopex pos
 *
 * https://docs.pekon.com/docCenter/home?docId=8b76bfb5
 *
 * @author sunjing@shopex.cn
 * @version 0.1
 *
 */
class erpapi_store_openapi_pekon_request_stock extends erpapi_store_request_stock
{
    /**
     * stock_get
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */

    public function stock_get($sdf)
    {
        $title = sprintf('【%s】库存查询', $this->__channelObj->store['name']);

        // if (!$sdf['material_bn']) {
        //     return $this->error('缺少基础物料编码');
        // }

        $warehouseCode = POS_DEFAULT_BRANCH;
        if (false !== strpos($sdf['branch_bn'], '_')) {
            $warehouseCode = array_pop(explode('_', $sdf['branch_bn']));
        }

        $store_bn = $this->__channelObj->store['store_bn'];
        $params = [
            'salesOrgCode'  => $this->__channelObj->store['store_bn'],
            'warehouseCode' => $warehouseCode,
            'pageNumber'    => $sdf['page_no'] ?: 1,
            'pageSize'      => $sdf['page_size'] ?: 100,
        ];

        if ($sdf['material_bn']) {
            $params['skuCodeArr'] = array_unique($sdf['material_bn']);
        }

        return $this->call('queryInventory', $params, null, $title, 30, $store_bn);
    }
}
