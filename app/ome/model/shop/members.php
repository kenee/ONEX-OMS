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

class ome_mdl_shop_members extends dbeav_model{
    /**
     * 须加密字段
     * simple:普通加密(不支持模糊查询)
     * @var string
     * */
    private  $__encrypt_cols = array(
        'shop_member_id' => 'simple'
    );

        /**
     * _filter
     * @param mixed $filter filter
     * @param mixed $tableAlias tableAlias
     * @param mixed $baseWhere baseWhere
     * @return mixed 返回值
     */
    public function _filter($filter,$tableAlias=null,$baseWhere=null)
    {
        $baseWhere = array();
        foreach ($filter as $key => $value) {
            $pos = strpos($key,'|');
            $field = false !== $pos ? substr($key,0,$pos): $key;

            $encrypt_type = $this->__encrypt_cols[$field];
            if ($encrypt_type) {
                $searchtype = false !== $pos ? substr($key,$pos+1): 'nequal';

                if ($searchtype!='nequal' && in_array($encrypt_type,array('search','nick','receiver_name'))) {
                    $encryptVal = kernel::single('ome_security_factory')->search($value,$encrypt_type);
                } else {
                    $encryptVal = kernel::single('ome_security_factory')->encryptPublic($value,$encrypt_type);
                }


                $originalVal      = utils::addslashes_array($value);
                $encryptVal = utils::addslashes_array($encryptVal);

                switch ($searchtype) {
                    case 'has':
                    case 'head':
                    case 'foot':
                        $baseWhere[] = "({$field} LIKE '%".$originalVal."%' || {$field} LIKE '%".$encryptVal."%')";
                        break;
                    default:
                        $baseWhere[] = "{$field} IN('".$originalVal."','".$encryptVal."')";
                        break;
                }

                unset($filter[$key]);
            }
        }

        return parent::_filter($filter,$tableAlias,$baseWhere);
    }

    public function getList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderType=null)
    {
        $data = parent::getList($cols,$filter,$offset,$limit,$orderType);

        foreach ((array) $data as $key => $value) {
            foreach ($this->__encrypt_cols as $field => $type) {
                if (isset($value[$field])) {
                    $data[$key][$field] = (string) kernel::single('ome_security_factory')->decryptPublic($value[$field],$type);
                }
            }
        }

        return $data;
    }

    /**
     * insert
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    public function insert(&$data)
    {
        foreach ($this->__encrypt_cols as $field => $type) {
            if (isset($data[$field])) {
                $data[$field] = (string) kernel::single('ome_security_factory')->encryptPublic($data[$field],$type);
            }
        }

        return parent::insert($data);
    }

    public function update($data,$filter=array(),$mustUpdate = null)
    {
        foreach ($this->__encrypt_cols as $field => $type) {
            if (isset($data[$field])) {
                $data[$field] = (string) kernel::single('ome_security_factory')->encryptPublic($data[$field],$type);
            }
        }

        return parent::update($data,$filter,$mustUpdate);
    }
}
?>