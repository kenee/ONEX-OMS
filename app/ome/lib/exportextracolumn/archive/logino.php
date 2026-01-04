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
 * 归档订单导出扩展字段物流单号
 * @author liuzecheng@shopex.cn
 * @version 1.0
 */
class ome_exportextracolumn_archive_logino extends ome_exportextracolumn_abstract implements ome_exportextracolumn_interface{

    protected $__pkey = 'order_id';

    protected $__extra_column = 'column_logi_no';

    /**
     *
     * 获取归档订单的物流单号
     * @param $ids
     * @return array $tmp_array关联数据数组
     */
    public function associatedData($ids){

        $sql = 'select ad.logi_no,aod.'.$this->__pkey.' from  sdb_archive_delivery_order as aod left join sdb_archive_delivery as ad on ad.delivery_id=aod.delivery_id where aod.order_id in ('.implode(',',$ids).')';
        $lists    = kernel::database()->select($sql);
        $tmp_array= array();
        foreach($lists as $list){
            $logi_no = $list['logi_no'];

            if(isset($tmp_array[$list[$this->__pkey]])){
               $tmp_array[$list[$this->__pkey]] .= ";".$logi_no;
            }else{
               $tmp_array[$list[$this->__pkey]] = $logi_no;
            }
        }
        return $tmp_array;
    }

}