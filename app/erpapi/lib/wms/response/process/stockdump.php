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
 * 转储单
 *
 * @category 
 * @package 
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_wms_response_process_stockdump
{
    /**
     * 转储单
     *
     * @param Array $params=array(
     *                  'status'=>@状态@ FINISH|FAILED|CANCEL|CLOSE
     *                  'io_source'=>selfwms
     *                  'stockdump_bn'=>@转储单号@
     *                  'memo'=>@备注@
     *                  'items'=>array(
     *                      'bn'=>@货号@
     *                      'num'=>@数量@
     *                  )
     *  
     *              )
     * @return void
     * @author 
     **/
    public function status_update($params)
    {
        return kernel::single('console_event_receive_stockdump')->ioStorage($params);
    }
}