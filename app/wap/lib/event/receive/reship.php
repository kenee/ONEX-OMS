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
 * 退换货事件处理类
 * 20170516
 * wangjianjun@shopex.cn
 */

class wap_event_receive_reship extends wap_event_response{

    /**
     * 退换货单创建事件
     * @param array $data
     */
    public function create($data){
        //创建
        $res = kernel::single('wap_receipt_reship')->create($data, $msg);
        if($res){
            return $this->send_succ();
        }else{
            return $this->send_error($msg);
        }
    }

    public function cancel($data){
       
        $res = kernel::single('wap_receipt_reship')->cancel($data, $msg);
        if($res){
            return $this->send_succ();
        }else{
            return $this->send_error($msg);
        }
    }
}

?>
