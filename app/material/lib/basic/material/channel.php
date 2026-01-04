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
 *
 */
class material_basic_material_channel extends eccommon_analysis_abstract implements eccommon_analysis_interface
{
    public $type_options = array(
        'display' => 'true',
    );
    
    /**
     * 获取_type
     * @return mixed 返回结果
     */

    public function get_type(){
        $return = array(
            'outer_product_id'=>array(
                'lab' => '云交易商品编码',
                'type' => 'text',
            ),
            'is_error'=>array(
                'lab' => '是否异常',
                'data' => [
                    '0'=>'请选择',
                    '1'=>'异常',
                    '2'=>'正常',
                ],
                'type' => 'select',
            ),
        );
        return $return;
    }
    /**
     * headers
     * @return mixed 返回值
     */
    public function headers(){
        $this->_render->pagedata['title'] = $this->_title;
        
        if($this->type_options['display'] == 'true'){
            $this->_render->pagedata['type_display'] = 'true';
            $this->_render->pagedata['typeData'] = $this->get_type();
            $this->_render->pagedata['type_selected'] = array(
                'outer_product_id'=>$this->_params['outer_product_id'],
                'is_error'=>isset($this->_params['is_error']) ? $this->_params['is_error'] : 1,
            );
            
        }
    }
    
    /**
     * 查找er
     * @return mixed 返回结果
     */
    public function finder(){
        $_GET['filter'] = array(
            'outer_product_id'=>$_POST['outer_product_id'],
            'is_error'=>isset($_GET['is_error']) ? $_GET['is_error'] : $this->_params['is_error'],
        );
        $_extra_view = array(
            'inventorydepth' => 'admin/extra_view.html',
        );
        
        $this->set_extra_view($_extra_view);
        
        $params = array(
            'title'               => '渠道商品列表',
            'use_buildin_recycle' => false,
            'use_buildin_filter'  => false,
            'use_buildin_export'  => true,
        );
        
        return array(
            'model' => 'material_mdl_basic_material_channel',
            'params' => $params,
        );
    }
    
    /**
     * 设置_params
     * @param mixed $params 参数
     * @return mixed 返回操作结果
     */
    public function set_params($params)
    {
        $this->_params = $params;
        
        return $this;
    }//End Function
    
    
}