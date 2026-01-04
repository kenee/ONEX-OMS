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

class erpapi_shop_matrix_shopex_bbc_response_aftersale extends erpapi_shop_response_aftersale {

    static public $return_type = array(
        'ONLY_REFUND'=>'refund',
        'REFUND_GOODS'=>'return',
        'EXCHANGING_GOODS'=>'change',
       
    );
    /**
     * 添加
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function add($params){
        $sdf = parent::add($params);
        
        $table_additional = $this->_aftersale_additional($params);
        if($table_additional){
            $sdf['table_additional'] = $table_additional;
        }
        $sdf['return_type'] = self::$return_type[$params['return_type']];
       return $sdf;
    }

    /**
     * _aftersale_additional
     * @param mixed $params 参数
     * @return mixed 返回值
     */
    public function _aftersale_additional($params){
  
        $shop_id   = $this->__channelObj->channel['shop_id'];

        if ($params['return_type']){
            $data = array(
                'shop_id'=>$shop_id,
                'return_bn'=>$params['return_bn'],
                'return_type'=>self::$return_type[$params['return_type']],
                'model'=>'return_product_bbc',
            );
            return $data;
            
        }
        
        
    }
}