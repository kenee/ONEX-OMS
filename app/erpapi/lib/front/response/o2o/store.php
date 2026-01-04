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
 *  前后端分离，门店类
 *
 * @author <chenping@shopex.cn>
 * @time 2020-11-18T19:26:39+08:00
 */
class erpapi_front_response_o2o_store extends erpapi_front_response_o2o_abstract
{
    /**
     * 门店列表查询，method=front.o2o.store.listing
     *
     * @return void
     * @author
     **/

    public function listing($params)
    {
        $this->__apilog['title'] = '门店列表查询';

        $filter = array(
            'status' => $params['status'] ? $params['status'] : '1',
        );
        return $filter;
    }

    /**
     * 门店详情查询，method=front.o2o.store.get
     *
     * @return void
     * @author
     **/
    public function get($params)
    {
        self::trim($params);

        $this->__apilog['title']       = '门店详情查询';
        $this->__apilog['original_bn'] = $params['store_bn'];

        if (!$params['store_bn']) {
            $this->__apilog['result']['msg'] = '缺少门店编码';
            return false;
        }

        return $params;

    }
}
