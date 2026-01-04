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
 * @description 电子发票短信触发事件
 * @access public
 * @param void
 * @return void
 */
class  taoexlib_sms_event_login extends taoexlib_sms_event_abstract implements taoexlib_sms_event_interface
{

    /**
     *
     * 短信模板标题
     * @var string
     */
    protected $_tmplTitle = '登录短信验证';

    /**
     *
     * 短信模板内容
     * @var string
     */
    protected $_tmplContent = 'shopex的oms登录验证码为{验证码}，10分钟内有效【商派业务中台】';

    /**
     *
     * 短信模板变量
     * @var array
     */
    protected function getTmplVariables(){
        return array(
            array('id' => 'yanzhengma', 'name' => '验证码', 'value' => '{验证码}','br'=>''),
        );
    }

    public function checkParams(&$params, &$error_msg){

        if(!$params["check_code"]){
            $error_msg = '验证码不能为空';
            return false;
        }

        return true;
    }

    public function formatContent($params, &$sendParams, &$error_msg){
        //获取短信模板内容
        $rule_sample_mdl = app::get('taoexlib')->model('sms_bind');
        if(!$content){
            $contentinfo = $rule_sample_mdl->getOtherSmsContent('login');
            if (!$contentinfo['content']) {
                $error_msg = '短信模板未设置或未审核通过';
                return false;
            }else{
                $content = $contentinfo['content'];
                $sendParams["tplid"] = $contentinfo['tplid'];
            }
        }

        //临时变量
        $check_code = $params['check_code'];
        //短信签名
        preg_match('/\【(.*?)\】/',$contentinfo['content'],$msgsign);
        $sendParams['phones'] = $params["telephone"];
        $sendParams['replace'] = array(
            'check_code' => $check_code,
            'msgsign' => $msgsign[0],
        );

        //替换签名 获取完整短信日志content
        $find = array('{验证码}');
        $replace = array($check_code);

        //获取短信日志content
        $sendParams['content'] = str_replace($find,$replace,$content);

        return true;
    }
}