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
*关联快递单号规则处理类
*
* @author sunjing<sunjing@shopex.cn>
* @version 2013-1-15 15:01
*/
class ome_print_logicfg{

    function __construct(&$app)
    {
        $this->app = $app;
    }


    function getLogiCfg(){
        $params=array(
            'POSTB'=>array(0=>'第一代',1=>'第二代(末位自增)'),
            'EMS'=>array(0=>'13年2月1号之前面单',1=>'13年2月1号之后面单'),
            'ZJS'=>array(0=>'旧版',1=>'新版'),
         );
        return $params;
        
    }
}

?>