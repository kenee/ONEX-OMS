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
*
*/
class inventorydepth_mdl_task_skus extends dbeav_model
{



    public function _finderFilter($filter){
        $where = array();
        $filter = utils::addslashes_array($filter);
        if ($filter['task_id']){
            $where[] = " skus.task_id='".$filter['task_id']."'";
        }
        if ($filter['shop_id']){
            $where[] = " skus.shop_id='".$filter['shop_id']."' AND sk.shop_id='".$filter['shop_id']."'";
        }
        if ($filter['sid']){
            if (is_array($filter['sid'])){
                $where[] = "skus.sid in('".implode('\',\'',$filter['sid'])."')";
            }else{
                $where[] = "skus.sid='".$filter['sid']."'";
            }
        }
        if ($filter['product_bn']){
            $where[] = "skus.product_bn like '".$filter['product_bn']."%'";
            unset($filter['product_bn']);
        }
        if ($where){
            return implode(' AND ',$where);
        }

    }

    function getFinderList($cols='*', $filter=array(), $offset=0, $limit=-1, $orderby=null){


        if(!$cols){
            $cols = $this->defaultCols;
        }
        if(!empty($this->appendCols)){
            $cols.=','.$this->appendCols;
        }

        $orderType = $orderType?$orderType:$this->defaultOrder;
        $sql = 'SELECT skus.sid,skus.task_id,skus.shop_id,skus.product_name,skus.product_bn,skus.product_id,skus.product_type,sk.id,sk.request,sk.shop_iid,sk.shop_id,sk.shop_bn,sk.shop_sku_id,sk.shop_type,sk.bind FROM sdb_inventorydepth_task_skus as skus LEFT JOIN sdb_inventorydepth_shop_skus as sk ON (skus.product_bn=sk.shop_product_bn AND skus.shop_id=sk.shop_id) WHERE '.$this->_finderFilter($filter).' ';

        if($orderType)$sql.=' ORDER BY sk.id DESC';

        $data = $this->db->selectLimit($sql,$limit,$offset);
        $this->tidy_data($data, $cols);

        return $data;
    }

    function countList($filter=array()){


        $sql = 'SELECT count(skus.sid) as _count FROM sdb_inventorydepth_task_skus as skus LEFT JOIN sdb_inventorydepth_shop_skus as sk ON (skus.product_bn=sk.shop_product_bn AND skus.shop_id=sk.shop_id) WHERE '.$this->_finderFilter($filter).' ';

        $row = $this->db->selectrow($sql);
        return intval($row['_count']);

    }
}
