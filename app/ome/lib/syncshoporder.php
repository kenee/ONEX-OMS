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
     * ShopEx licence
     *
     * @copyright  Copyright (c) 2005-2012 ShopEx Technologies Inc. (http://www.shopex.cn)
     * @license  http://ecos.shopex.cn/ ShopEx License
     * @version tg---yangminsheng
     * @date 2012-06-19
     */

class ome_syncshoporder{

    function create($queue_title,$method,$params,&$oApi_log,$status){

      $log_id = $oApi_log->gen_id();

      $oApi_log->write_log($log_id,$queue_title,'ome_rpc_request','rpc_request',$params,'request',$status,'');

      return true;
    }

    function fetchAll(&$apilog){
       $params = array();

       $params = $apilog->getList('order_bn,shop_id,log_id',array('status'=>'running','order_bn|noequal'=>''));

       return $params;
    }
}