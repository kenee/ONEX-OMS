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

abstract class openapi_api_params_abstract{

    protected function checkParams($method,$params,&$sub_msg){
        $defined_params = $this->getAppParams($method);
        if(empty($defined_params)){
            return false;
        }
        foreach($defined_params as $defined_param => $attribute){
            if(isset($attribute['required']) && $attribute['required'] == 'true'){
                if(!isset($params[$defined_param])){
                    return false;
                }
            }else {
            	if (empty($params[$defined_param])){
            		continue;
            	}
            }

            
            switch($attribute['type']){
                case 'money':
                    if(!is_double($params[$defined_param])){
                        return false;
                    }
                    break;
                case 'date':
                    if(!preg_match("([0-9]{4}-[0-9]{2}-[0-9]{2})",$params[$defined_param])){
                        return false;
                    }
                    break;
                case 'number':
                    if(!is_numeric($params[$defined_param]) || $params[$defined_param]<= 0){
                        return false;
                    }
                    break;
                case 'string':
                    if(!is_string($params[$defined_param])){
                        return false;
                    }
                    break;
            }
        }

        return true;
    }

}