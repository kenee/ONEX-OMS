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
 * ============================
 * @Author:   Xueing
 * @Version:  1.0
 * @DateTime: 2021/05/13 19:36:45
 * @describe: 类
 * ============================
 */
class erpapi_wms_matrix_yjdf_response_goods extends erpapi_wms_response_goods
{
    
    /**
     * 云交易商品信息变更MQ wms.goods.status_update
     * @param $params
     * @return bool
     */

    public function status_update($params)
    {
        $data = parent::status_update($params);
        
        if (empty($data['sku_id'])) {
            $this->__apilog['result']['msg'] = '物料编码为空';
            return false;
        }
        
        if (empty($data['channel_id'])) {
            $this->__apilog['result']['msg'] = '渠道id不能为空';
            return false;
        }
        
        if ($data['type'] != 2) {
            //0-删除（京东商品删除） 1-新增 2-修改 3-删除恢复（京东商品删除恢复）。目前只有2修改场景，其他暂无。
            $this->__apilog['result']['msg'] = '云交易商品信息变更状态不为修改，暂无操作';
            return false;
        }
        
        return $data;
    }
}