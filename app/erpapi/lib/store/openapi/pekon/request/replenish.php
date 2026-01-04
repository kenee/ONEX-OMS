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
 * 补货同步pos
 *
 * @category
 * @package
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_store_openapi_pekon_request_replenish extends erpapi_store_request_replenish
{

    


    protected function _format_check_params($sdf)
    {

        $params = array(
           'docNo'          =>  $sdf['task_bn'],
           'auditAction'    =>  'APPROVE',

        );
            
       
        return $params;
    }

    protected function get_check_apiname()
    {

        return 'AuditInvOrderDocument';
    }

   
    protected function _format_cancel_params($sdf)
    {

        $params = array(
           'docNo'          =>  $sdf['task_bn'],
           'auditAction'    =>  'REJECT',
           'auditReason'    =>  '',
        );
            
       
        return $params;
    }

    protected function get_cancel_apiname()
    {

        return 'AuditInvOrderDocument';
    }
}
