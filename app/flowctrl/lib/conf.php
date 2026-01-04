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
 * 特性配置管理Lib类
 * @author xiayuanjun@shopex.cn
 * @version 1.0
 */
class flowctrl_conf {

    /**
     * 获取事件节点列表方法
     *
     * @param Null
     * @return Array
     */
    public function getNodeList(){
        return array(
            array('code'=>'purchase_stockin','name'=>'采购入库方式'),
            array('code'=>'purchasereturn_stockout','name'=>'采购退货出库方式'),
            //array('code'=>'allocate_stockoutin','name'=>'调拨出入库方式'),
        );
    }

    /**
     * 根据事件节点获取对应的配置页信息
     *
     * @param String $code 特性标识
     * @return Array
     */
    public function getNodeCnfByNode($node){
        $node_className = sprintf('flowctrl_node_%s',$node);
        try{
            if(class_exists($node_className)){
                $nodeLib = kernel::single($node_className);
                if(is_object($nodeLib) && method_exists($nodeLib,'getConfig')){
                    return $nodeLib->getConfig();
                }else{
                    return $nodes;
                }
            }else{
                return $nodes;
            }
        } catch (Exception $e) {
            // do nothing
        }
    }

    /**
     * 根据事件节点获取当前的配置描述
     *
     * @param String $code 特性标识
     * @param Array $cnf 配置信息
     * @return Array
     */
    public function getNodeCnfDescByNode($node,$cnf){
        $node_className = sprintf('flowctrl_node_%s',$node);
        try{
            if(class_exists($node_className)){
                $nodeLib = kernel::single($node_className);
                if(is_object($nodeLib) && method_exists($nodeLib,'showConfigDesc')){
                    return $nodeLib->showConfigDesc($cnf);
                }else{
                    return $nodes;
                }
            }else{
                return $nodes;
            }
        } catch (Exception $e) {
            // do nothing
        }
    }
}
