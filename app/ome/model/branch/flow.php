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

class ome_mdl_branch_flow extends dbeav_model{

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function modifier_content($val, $list, $row)
    {

        try {
            $class_name = 'ome_branch_flow_'.$row['flow_type'];

            $obj = kernel::single($class_name);

            return call_user_func_array([$obj, 'translateContent'], [$val]);
        } catch (Exception $e) {
            return '';
        }
    }
}
