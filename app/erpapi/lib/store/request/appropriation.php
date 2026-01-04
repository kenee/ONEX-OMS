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
 * 调拔单
 *
 * @category
 * @package
 * @author sunjing
 * @version $Id: Z
 */
class erpapi_store_request_appropriation extends erpapi_store_request_abstract
{

    /**
     * 调拔单审核
     * 
     * @return void
     * @author
     * */

    public function appropriation_check($sdf)
    {
        $title = $this->__channelObj->wms['channel_name'].'调拔单审核';

        $params = $this->_format_check_params($sdf);
       

        if (!$params) {
            return $this->succ('未定义无需同步');
        }

        $method = $this->get_check_apiname($sdf);
        if(!$method){
            return $this->succ('未定义无需同步');
        }


        $result = $this->call($method, $params, null, $title, 30, $sdf['appropriation_no']);
       
        return $result;

    }


    protected function _format_check_params($sdf)
    {

        $params = array(
           
        );
            
       
        return $params;
    }

    protected function get_check_apiname($sdf)
    {


    }

        /**
     * appropriation_audit
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function appropriation_audit($sdf){
        $title = $this->__channelObj->wms['channel_name'].'调拔单审批';

        $params = $this->_format_audit_params($sdf);
       

        if (!$params) {
            return $this->succ('未定义无需同步');
        }

        $method = $this->get_audit_apiname($sdf);
        if(!$method){
            return $this->succ('未定义无需同步');
        }

        $result = $this->call($method, $params, null, $title, 30, $sdf['appropriation_no']);
        return $result;
    }

    protected function _format_audit_params($sdf)
    {

        $params = array(
           
        );
            
       
        return $params;
    }

    protected function get_audit_apiname($sdf)
    {

        
    }

}
