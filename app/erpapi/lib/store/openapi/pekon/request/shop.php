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
 * 门店同步pos
 *
 * @category
 * @package
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_store_openapi_pekon_request_shop extends erpapi_store_request_shop
{

    
    protected function _format_shop_add_params($sdf)
    {

        list($province, $city, $district) = explode('/', $sdf['area']);
        $params = array(
           'originDataId'           =>  $sdf['store_bn'],
           'orgBusinessTypeCode'    =>  'ADMIN',
           'code'                   =>  $sdf['store_bn'],
           'name'                   =>  $sdf['name'],
         
           'orgTypeId'              =>  'SHOP',
           'status'                 =>  'Y',//状态。标识数据是否有效。Y：有效   N：无效
           'originDataUpdatedTime'  =>  date('Y-m-d',$sdf['create_time']),
           'address'                =>  $sdf['addr'],//详细地址
           'telephone'              =>  $sdf['mobile'],
           'isValid'                =>  'Y',//是否正式数据
           
           'countryCode'            =>  'CN',//固定值：CN
           //'regionLeafCode'         =>  '',//区域编码
   
           'telephone'              =>  $sdf['mobile'],//联系电话
           //'openDate'               =>  ,
           //'closeDate'              =>  ,
           //'businessFromTime'       =>  ,
           //'businessToTime'         =>  ,
           'counterType'            =>  $sdf['store_sort'],
           'counterTypeName'        =>  $sdf['store_sort'],
           'provinceName'           =>  $province,
           'cityName'               =>  $city,
           'countyName'             =>  $district,

        );
            
       
        return $params;
    }

    protected function get_shop_add_apiname()
    {

        return 'synchOrganizationByInterface';
    }

    
}
