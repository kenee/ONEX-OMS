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
 * @author ykm 2021/7/15 14:42:57
 * @describe 模板数据获取
 */
class erpapi_logistics_matrix_douyin_request_template extends erpapi_logistics_request_template {

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
        $this->title = '获取抖音标准模板';
        $rs = $this->requestCall(STORE_STANDARD_DY_TEMPLATE, array());
        if($rs['rsp'] == 'succ' && $rs['data']) {
            $standardResult = json_decode($rs['data'], true);
            $rs['data'] = array();
            if($standardResult) {
                $stCodeUrl = [];
                foreach ($standardResult as $val) {
                    foreach ($val['template_infos'] as $sVal) {
                        $stCodeUrl[$sVal['template_code']] = $sVal['template_url'];
                        $template_data = ['template_code'=>$sVal['template_code'], 'template_url'=>$sVal['template_url']];
                        $rs['data'][] = array(
                            'tpl_index' => 'standard' . '-' . $sVal['template_code'],
                            'cp_code' => $val['logistics_code'],
                            'out_template_id' => $sVal['template_code'],
                            'template_name' => $sVal['template_name'] . '(抖音)',
                            'template_type' => 'douyin_standard',
                            'template_data' => json_encode($template_data)
                        );
                    }
                }
                $this->title = '店铺(' . $this->__channelObj->channel['name'] . ')' . $this->__channelObj->channel['channel_type'] . '获取用户模板';
                $rsUser = $this->requestCall(STORE_STANDARD_DY_TEMPLATE, array("template_type"=> "customer"));
                if($rsUser['rsp'] == 'succ' && $rsUser['data']) {
                    $userResult = json_decode($rsUser['data'], true);
                    if($userResult) {
                        foreach ($userResult as $val) {
                            foreach ($val['custom_template_infos'] as $sVal) {
                                $template_data = ['template_code'=>$sVal['parent_template_code'], 'template_url'=>$stCodeUrl[$sVal['parent_template_code']], 'custom_template_code'=>$sVal['custom_template_code'],'custom_template_url'=>$sVal['custom_template_url']];
                                $rs['data'][] = array(
                                    'tpl_index' => 'user' . '-' . $sVal['custom_template_code'],
                                    'cp_code' => $val['logistics_code'],
                                    'out_template_id' => $sVal['custom_template_code'],
                                    'template_name' => $sVal['custom_template_name'],
                                    'template_type' => 'douyin_user',
                                    'template_data' => json_encode($template_data),
                                );
                            }
                        }
                    }
                }
                $this->title = '店铺(' . $this->__channelObj->channel['name'] . ')' . $this->__channelObj->channel['channel_type'] . '获取用户模板数据';
                $rsUser = $this->requestCall(STORE_STANDARD_DY_TEMPLATE, array("template_type"=> "custom_2"));
                if($rsUser['rsp'] == 'succ' && $rsUser['data']) {
                    $userResult = json_decode($rsUser['data'], true);
                    if($userResult) {
                        foreach ($userResult as $val) {
                            foreach ($val['custom_template_infos'] as $sVal) {
                                $template_data = ['template_code'=>$sVal['parent_template_code'], 'template_url'=>$stCodeUrl[$sVal['parent_template_code']], 'custom_template_code'=>$sVal['custom_template_code'],'custom_template_url'=>$sVal['custom_template_url']];
                                $template_select =[];
                                foreach ($sVal['custom_template_key_list'] as $ctval) {
                                    $template_select[] = str_replace(array('_data.'), '', $ctval);
                                }
                                $rs['data'][] = array(
                                    'tpl_index' => 'user' . '-' . $sVal['custom_template_code'],
                                    'cp_code' => $val['logistics_code'],
                                    'out_template_id' => $sVal['custom_template_code'],
                                    'template_name' => $sVal['custom_template_name'],
                                    'template_type' => 'douyin_user',
                                    'template_data' => json_encode($template_data),
                                    'template_select' => $template_select
                                );
                            }
                        }
                    }
                }
            }
        } else {
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