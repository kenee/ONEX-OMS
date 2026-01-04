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

class taoexlib_mdl_sms_rule extends dbeav_model 
{

    
    /**
     * 根据规则id获取绑定关系信息
     *
     * @param  $rule_id
     * @return void
     * @author 
     **/
    public function getBindByRuleId($rule_id)
    {
    	$res = app::get('taoexlib')->model('sms_bind')->select()->columns()->where('tid=?',$rule_id)->instance()->fetch_row();
    	return $res;
    }
}