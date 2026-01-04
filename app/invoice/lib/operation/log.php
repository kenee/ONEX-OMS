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

class invoice_operation_log{
	    
    function get_operations(){
        $operations = array(
           'invoice_create' => array('name'=> '发票创建','type' => 'order@invoice'),
           'invoice_cancel' => array('name'=> '发票作废','type' => 'order@invoice'),
           'invoice_billing' => array('name'=> '发票开票','type' => 'order@invoice'),
           'invoice_edit' => array('name'=> '发票编辑','type' => 'order@invoice'),
           'einvoice_prepare_tmall' => array('name'=> '电子发票的天猫状态更新','type' => 'order@invoice'),
           'einvoice_upload_tmall' => array('name'=> '电子发票上传天猫','type' => 'order@invoice'),
           'einvoice_upload'        => array('name' => '电子发票上传', 'type' => 'order@invoice'),
           'invoice_print' => array('name'=> '发票打印','type' => 'order@invoice'),
        );
        return array('invoice'=>$operations);
    }
}