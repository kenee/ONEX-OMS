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


class inventorydepth_mdl_log extends dbeav_model {

    /**
     * 保存日志
     *
     * @return void
     * @author 
     **/
    public function saveLog($data)
    {
        # 判断是否日志已经存在
        $id = $this->select()->columns('log_id')
                ->where('shop_id=?',$data['shop_id'])
                ->where('bn=?',$data['bn'])
                ->instance()->fetch_one();
        # 更新
        if ($id) {
            $this->update($data,array('log_id' => $id));
        }else{
            # 保存
            $this->insert($data);
        }
    }

}
