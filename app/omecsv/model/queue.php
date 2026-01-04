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
 * 任务队列模型类
 * Class omecsv_mdl_queue
 */
class omecsv_mdl_queue extends dbeav_model
{
    
    public function getRow($cols = '*', $filter = array())
    {
        $sql = "SELECT $cols FROM " . $this->table_name(true) . " WHERE " . $this->filter($filter);
        return $this->db->selectrow($sql);
    }
    
    public function modifier_error_msg($error_msg,$list,$row)
    {
        return $error_msg ? implode("；", unserialize($error_msg)).';' : '';
    }
    
}