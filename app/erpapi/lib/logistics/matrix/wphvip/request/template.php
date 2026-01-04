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

class erpapi_logistics_matrix_wphvip_request_template extends erpapi_logistics_request_template {
    /**
     * syncStandardTpl
     * @return mixed 返回值
     */
    public function syncStandardTpl() {
        return ['rsp'=>'succ'];
    }

    /**
     * syncUserTpl
     * @return mixed 返回值
     */
    public function syncUserTpl() {

        $this->title = '唯品会VIP店铺(' . $this->__channelObj->channel['shop_id'] . ')' . $this->__channelObj->channel['channel_type'] . '获取('.$this->__channelObj->channel['logistics_code'].')模板';
        $shop = app::get("ome")->model('shop')->dump(['shop_id'=>$this->__channelObj->channel['shop_id']]);
        if(empty($shop['addon']['user_id'])){
            return array('rsp'=>'fail','msg'=>'缺少店铺id,请重新授权');
        }
        $rs = $this->requestCall(STORE_STANDARD_DY_TEMPLATE, array('ownerId'=>$shop['addon']['user_id'],'carrierCode'=>$this->__channelObj->channel['logistics_code']));

        if($rs['rsp'] == 'succ' && $rs['data']) {
            $result = json_decode($rs['data'],1);
            $result = json_decode($result['msg'],1);
            $rs['data'] = array();
            if(!empty($result['result']['model']['templates'])){
                foreach($result['result']['model']['templates'] as $sVal){

                    $rs['data'][] = array(
                        'tpl_index' => 'user' . '-' . $sVal['templateId'],
                        'cp_code' => $sVal['carrierCode'],
                        'out_template_id' => $sVal['templateId'],
                        'template_name' => $sVal['templateName'].'(唯品会vip)',
                        'template_type' => 'wphvip_user',
                        'template_select' => '',
                        'template_data' =>   $sVal['templateUrl'],
                    );
                }
            }else{
                return array('rsp'=>'fail','msg'=>$result['result']['header']['resultMsg']);
            }

        }else {
            $rs['data'] = array();
        }

        return $rs;
    }

    /**
     * 获取UserDefinedTpl
     * @param mixed $params 参数
     * @return mixed 返回结果
     */
    public function getUserDefinedTpl($params) {
        return ['rsp'=>'succ'];
    }
}