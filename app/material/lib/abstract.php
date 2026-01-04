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
 * 公共抽象类
 *
 * @author wangbiao@shopex.cn
 * @version 2022.07.25
 */
abstract class material_abstract
{
    /**
     * 成功输出
     *
     * @param string $msg
     * @param string $data
     * @return array
     */
    final public function succ($msg='', $data=null)
    {
        return array('rsp'=>'succ', 'msg'=>$msg, 'data'=>$data);
    }
    
    /**
     * 失败输出
     *
     * @param string $msg
     * @param string $data
     * @return array
     */
    final public function error($error_msg, $data=null)
    {
        return array('rsp'=>'fail', 'msg'=>$error_msg, 'error_msg'=>$error_msg, 'data'=>$data);
    }
    
    /**
     * 根据比例随机获取数组中的数据
     *
     * @param $items 列表数据
     * @return mixed
     */
    protected function ratioRandom($items)
    {
        //获取比例列表值
        $ratioList = array_column($items, 'real_ratio');
        
        //计算总权重
        $totalRatio = array_sum($ratioList);
        
        //生成一个介于0和总权重之间的随机数
        //@todo：放大1000倍,更能体现随机精细度
        $rand = mt_rand(0, $totalRatio * 1000) / 1000;
        
        //遍历数组，直到随机数小于等于当前累积的权重
        foreach ($items as $item)
        {
            //返回随机的结果
            if ($rand <= $item['real_ratio']) {
                return $item;
            }
            
            $rand -= $item['real_ratio'];
        }
        
        //[递归执行]如果没有找到(理论上不应该发生)
        //return $this->ratioRandom($items);
        return $item;
    }
    
    /**
     * 按贡献占比降序排序
     *
     * @param $a
     * @param $b
     * @return int
     */
    protected function compare_by_name($a, $b)
    {
        return strcmp($b['rate'], $a['rate']);
    }
}
