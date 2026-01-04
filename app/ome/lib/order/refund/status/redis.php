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

class ome_order_refund_status_redis extends ome_order_refund_status_abstract {
    static private $_redisObj = null;

    function __construct() 
    {
        $this->connect();
    }//End Function

    /**
     * connect
     * @return mixed 返回值
     */
    public function connect() 
    {
        if(!isset(self::$_redisObj)){
            if(defined('TMC_REFUND_REDIS_CONFIG') && constant('TMC_REFUND_REDIS_CONFIG')){
                self::$_redisObj = new Redis;
                $config = explode(':', TMC_REFUND_REDIS_CONFIG);
                self::$_redisObj->connect($config[0], $config[1]);

                // 用户密码
                if(defined('TMC_REFUND_REDIS_AUTH') && constant('TMC_REFUND_REDIS_AUTH')){
                    self::$_redisObj->auth(TMC_REFUND_REDIS_AUTH);
                }

                //Specify a database
                if(isset($config[2]) && $config[2] >= 0){
                    self::$_redisObj->select($config[2]);
                }


            }else{
                trigger_error('can\'t load TMC_REFUND_REDIS_CONFIG, please check it', E_USER_ERROR);
            }
        }
    }

    /**
     * [fetch description]
     * @param  string $tid    [description]
     * @param  string $nodeId [description]
     * @param  string $shopId [description]
     * @return array         array (
                                      0 => true,
                                      1 => 
                                      array (
                                        'data' => 
                                        array (
                                          2918463734761365258 => '{"buyer_nick":"c**","buyer_open_uid":"AAHLuAVrAABxoR0DtQv2KKHi","refund_phase":"onsale","refund_fee":"1.00","modified":"2022-09-29 14:17:15","bill_type":"refund_bill","oid":2918463734761365258,"seller_nick":"dongqiujing","refund_id":181784773340365852,"tid":2918463734761365258}',
                                        ),
                                      ),
                                    )
     */

    public function fetch($tid, $nodeId, $shopId){
        if(!self::$_redisObj->ping()) {
            return [false, ['msg'=>'redis ping fail']];
        }
        $key = $this->getKey($tid, $nodeId);
        $result = self::$_redisObj->hGetAll($key);
        return [true, ['data'=>$result]];
    }

    /**
     * store
     * @param mixed $sdf sdf
     * @return mixed 返回值
     */
    public function store($sdf) {
        if(!self::$_redisObj->ping()) {
            return [false, ['msg'=>'redis ping fail']];
        }
        $key = $this->getKey($sdf['tid'], $sdf['node_id']);
        self::$_redisObj->hSet($key, $sdf['oid'], json_encode($sdf));
        return [true, ['msg'=>'写入redis成功']];
    }
}