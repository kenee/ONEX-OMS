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
 * 规则模型类
 *
 * @author chenping<chenping@shopex.cn>
 */

class inventorydepth_mdl_regulation extends dbeav_model
{
    public function modifier_using($row) 
    {
        $using = '';
        if ($row == 'true') {
            $using = '<span style="color:green;">已启用</span>';
        } else {
            $using = '<span style="color:red;">未启用</span>';
        }

        return $using;
    }

    public function pre_recycle($rows) 
    {
        foreach ($rows as $key=>$row) {
            $rid[] = $row['regulation_id'];
        }
        $apply = $this->app->model('regulation_apply')->getList('id',array('regulation_id'=>$rid,'using'=>'true'),0,1);
        if ($apply) {
            $this->recycle_msg = '规则对应的应用已经开启，无法进行删除！';
            return false;
        }
        return true;
    }
}
