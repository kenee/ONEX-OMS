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

class ome_desktop_widgets_productinfo implements desktop_interface_widget{

    var $order = 5;

    function __construct($app){
        $this->app = $app; 
        $this->render =  new base_render(app::get('ome'));  
    }
    
    function get_title(){
        return app::get('ome')->_("产品信息");
    }

    function get_html(){
        $render = $this->render;
        $data = array();
        $deploy = kernel::single('base_xml')->xml2array(file_get_contents(ROOT_DIR.'/config/deploy.xml'),'base_deploy');

        if(function_exists('zend_loader_file_licensed') && zend_loader_file_licensed()){
            $zend_info = zend_loader_file_licensed();
            if($zend_info){
                if(strpos($zend_info['Product-Name'], 'source') !== false){
                    $prd_name_ext = '开发授权';
                }else{
                    $prd_name_ext = '标准授权';
                }

                if(strpos($zend_info['Product-Name'], 'php5.6') !== false){
                    $prd_ver_ext = 'PHP5.6';
                }else{
                    $prd_ver_ext = 'PHP5.3';
                }
            }
        }

        $data[0]['label'] = '产品名称';
        $data[0]['value'] = $deploy['product_name'].'  '.$prd_name_ext;

        $product_info = explode('.', $deploy['ver']);
        $is_custom = defined('CUSTOM_CORE_DIR') ? '定制版' : '标准版';
        $data[1]['label'] = '产品版本';
        $data[1]['value'] = 'v'.$product_info[0].'.'.$product_info[1].'.'.$product_info[2].'  '.$prd_ver_ext.'  '.$is_custom;

        $data[2]['label'] = '发布时间';
        $data[2]['value'] = date('Y-m-d',strtotime($product_info[3]));

        $data[3]['label'] = '授权节点号';
        $data[3]['value'] = base_shopnode::node_id('ome');

        $data[4]['label'] = '授权证书号';
        $data[4]['value'] = base_certificate::get('certificate_id');

        $data[5]['label'] = '绑定企业账号';
        $data[5]['value'] = base_enterprise::ent_id();

        $data[6]['label'] = '绑定企业邮箱';
        $data[6]['value'] = base_enterprise::ent_email();

        $render->pagedata['data'] = $data;
        $html = $render->fetch('desktop/widgets/productinfo.html');
        return $html;
    }

    function get_className(){
        return "";
    }

    function get_width(){
        return "l-2";
    }
    
}

?>