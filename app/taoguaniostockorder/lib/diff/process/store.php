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
 * 门店责任
 *
 * @package default
 * @author chenping@shopex.cn
 * @version Sun Apr  3 20:23:31 2022
 **/
class taoguaniostockorder_diff_process_store extends taoguaniostockorder_diff_process_abstract
{
    /**
     * 仓发店短发
     * @param $data
     * @return array|void
     */

    public function b2sLess($data)
     {
         return $this->storeAddStock($data);
     }
    
    /**
     * 仓发店超发
     * @param $data
     * @return array|void
     */
    public function b2sMore($data)
    {
        return $this->storeSubStock($data);
    
    }
    
    /**
     * 仓发店错发（错发逻辑拆分成超发和短发处理）
     * 
     * @return void
     * @author
     * */
//    public function b2sWrong($data){}
    
    /**
     * 店退仓短发
     * @param $data
     * @return array|void
     */
    public function s2bLess($data)
    {
        return $this->storeAddStock($data);
    }
    
    
    /**
     * 店退仓超发
     * @param $data
     * @return array|void
     */
    public function s2bMore($data)
    {
        return $this->storeSubStock($data);
    
    }
    
    /**
     * 店退仓错发
     * 
     * @return void
     * @author
     * */
//    public function s2bWrong($data){}
    
    /**
     * 店转店短发
     * @param $data
     * @return array|void
     */
    public function s2sLess($data)
    {
        return $this->storeAddStock($data);
    }
    
    
    /**
     * 店转店超发
     * @param $data
     * @return array|void
     */
    public function s2sMore($data)
    {
        return $this->storeSubStock($data);
    }
    
    /**
     * 仓转仓短发
     *
     * @return void
     * @author
     **/
    public function b2bLess($data){}
    
    /**
     * 仓转仓超发
     *
     * @return void
     * @author
     **/
    public function b2bMore($data){}
    
    /**
     * 店转店错发
     *
     * @return void
     * @author
     **/
//    public function s2sWrong($data){}
}