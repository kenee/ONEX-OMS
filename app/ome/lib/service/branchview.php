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


class ome_service_branchview{
    
   /**
    * 显示选择仓库
    * @param int $branch_id 仓库ID
    * @param string $url    form提交的地址
    * @param string $title  标题显示
    * @param string $method form提交的方式 
    */
   public function getBranchView($branch_id, $url, $title='查看', $method='GET'){
       return kernel::single("ome_branch_view")->getBranchView($branch_id, $url, $title, $method);
   }
}