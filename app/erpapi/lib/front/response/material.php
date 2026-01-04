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
 *  前后端分离，基础物料类
 *
 * @author <chenping@shopex.cn>
 * @time 2020-11-18T19:26:39+08:00
 */
class erpapi_front_response_material extends erpapi_front_response_abstract
{
    /**
     * 管理员登陆，method=front.material.get
     *
     * @author
     **/

    public function get($params)
    {
        $this->__apilog['title']       = '基础物料详情查询';
        $this->__apilog['original_bn'] = $params['bn'];

        if (!$params['bn']) {
            $this->__apilog['result']['msg'] = '缺少基础物料编码';
            return false;
        }

        $filter = array(
            'bn' => trim($params['bn']),
        );

        return $filter;
    }
}
