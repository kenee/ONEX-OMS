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
 * 使用数据库来生成自增GUID
 */

class ome_concurrent_guid {
	
    /**
     * 单例对像
     */
    static public $_instance = null;

    /**
     * 获取单例对像
     *
     * @param void
     * @return ome_concurrent_guid
     */
    static public function instance() {

        if (!is_object(self::$_instance)) {

            self::$_instance = new ome_concurrent_guid();
        }

        return self::$_instance;
    }

	/**
	 * 获取自增ID
     *
     * @param $type
     * @param $prefix
     * @param $length
     * @param $fix
     * @return Integer
	 */
	public function increment($type, $prefix ,$length, $fixed) {

        if ($fixed) {

            $fix = $prefix . $this->getUUIDFix();
            $sql = "SELECT id,`current_time` FROM sdb_ome_concurrent WHERE `current_time`<=".time()." and type='$type' and id like '{$fix}%' order by id desc limit 0,1";
        } else {

            $sql = "SELECT id,`current_time` FROM sdb_ome_concurrent WHERE `current_time`<=".time()." and type='$type' and id like '{$prefix}%' order by id desc limit 0,1";
        }

        $ret = kernel::database()->select($sql);
        //默认值设定
        $num = 1;

        if (is_array($ret)) {
            $ret = $ret[0];
            //检查是否当天的ID
            if (date('y-m-d', $ret['current_time']) == date('y-m-d', time())) {
                //是今天的
                $num = substr($ret['id'], 0 - $length);
                $num = intval($num)+1;
            }
        }

        return $num;
	} 

	/**
	 * 保存并校验指定类型的GUID是否可用
	 *
	 * @return Boolean
	 */
    public function _vaildGUID($type, $guid)
    {
        try {
            $res = kernel::database()->exec('INSERT INTO sdb_ome_concurrent(`id`,`type`,`current_time`)VALUES("'.$guid.'","'.$type.'","'.time().'")');
            return $res ? true : false;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 判断编号是否存在
     *
     * @return void
     * @author 
     **/
    public function _existGUID($type, $guid)
    {
        $row = kernel::database()->selectrow('SELECT `id` FROM sdb_ome_concurrent WHERE `id`="'.$guid.'" AND `type`="'.$type.'"');
        return $row;
    }

    /**
     * 返回本插件的UID识别字段值
     *
     * @return String
     */
    public function getUUIDFix() {

        return '0';
    }
}