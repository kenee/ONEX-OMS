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

class ome_view_helper2{

    function __construct(&$app){
        $this->app = $app;
    }

    /**
     * modifier_visibility
     * @param mixed $productName productName
     * @param mixed $productId ID
     * @return mixed 返回值
     */
    public function modifier_visibility($productName,$productId){
        if (!$productId) {
            return $productName;
        }

        $basicMaterialObj = app::get('material')->model('basic_material');
        $visibility = $basicMaterialObj->select()->columns('visibled')->where('bm_id=?',$productId)->instance()->fetch_one();
        $style = ($visibility==2) ? 'color:#808080;width:100%;' : '';
        $visibility = ($visibility==2) ? 'false' : 'true';
        return '<span style='.$style.' class="product-name" visibility='.$visibility.' onmouseover=visibility(event);>'.$productName.'</span>';
    }

    /**
     * modifier_ciphertext
     * @param mixed $string string
     * @param mixed $data_type 数据
     * @param mixed $field field
     * @param mixed $shop_type shop_type
     * @return mixed 返回值
     */
    public function modifier_ciphertext($string, $data_type, $field, $shop_type = 'taobao'){
        if (!$shop_type) $shop_type = 'taobao';

        $bHelper = kernel::single('base_view_helper', $this->app);

        $is_encrypt = kernel::single('ome_security_hash')->check_encrypt($string);

        if ($is_encrypt) {
            $hashCode = kernel::single('ome_security_hash')->get_code();

            if($index = strpos($string, '>>')) {
                return substr($string, 0, $index);
            }
            if($index = strpos($string, '&gt;&gt;')) {
                return substr($string, 0, $index);
            }
            if(strpos($string, '*')) {
                return str_replace($hashCode, '', $string);
            }

            return $bHelper->modifier_cut($string,'-1',strlen($string) > 11 ?'****':'*',false,true);
        }

        return $string;
    }

    /**
     * @description
     * @access public
     * @param void
     * @return void
     */
    public function function_button_permission($params, &$smarty) 
    {
        # 判断是否有权限 且不是超级管理员
        $userLib = kernel::single('desktop_user');
        if (!$userLib->is_super()) {
            $group = $userLib->group();
            if (isset($params['permission'])) {
                $permission_id = $params['permission'];
            }elseif(isset($params['url'])){
                $url = parse_url($params['url']);
                parse_str($url['query'],$url_params);

                $menus = app::get('desktop')->model('menus');
                $permission_id = $menus->permissionId($url_params);
            }

            if ($permission_id && !in_array($permission_id,$group)) {
                $params['style'] = 'display:none;';
            }
        }


        return kernel::single('base_render')->ui()->button($params);
    }
}
