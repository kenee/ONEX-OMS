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

class erpapi_errcode{

    public $errcode;
    /**
     * __construct
     * @return mixed 返回值
     */
    public function __construct(){
        $this->errcode = array(
            'shop'  =>  $this->shop,
            'wms'   =>  $this->wms,
        );
    }

    /**
     * 获取Errcode
     * @param mixed $channel_type channel_type
     * @return mixed 返回结果
     */
    public function getErrcode($channel_type)
    {
        return $this->errcode[$channel_type];
    }

    private $shop=array(
        'G40012'   =>   array('primary_bn'=>'delivery_bn', 'obj_type'=>'JDDELIVERY', 'retry'=>1),
    );



    private $wms = array(
        'e00090'        =>   array( 'retry'=>1 ),
        'ERP00090'      =>   array( 'retry'=>1 ),
        'W30012'        =>   array('primary_bn'=>'delivery_bn', 'obj_type'=>'deliveryship', 'retry'=>1),
    );

}
