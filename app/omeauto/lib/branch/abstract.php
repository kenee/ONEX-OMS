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
 * ============================
 * @Author:   yaokangming
 * @Version:  1.0 
 * @DateTime: 2020/9/8 17:16:49
 * @describe: 类
 * ============================
 */
abstract class omeauto_branch_abstract {

    /**
     * 优选仓库
     * @param  array $branchIds 仓库ID
     * @param  array $group    订单分组
     * @param  array $branchInfo    仓库库存信息
     * @return array            仓库ID
     */
    abstract public function process($branchIds, &$group, $branchInfo);
}