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

class logisticsmanager_mdl_waybill_extend extends dbeav_model {
    
    /**
     * 根据单号返回大头笔是否存在
     * @param 
     * @return 
     * @access  public
     * @author sunjing@shopex.cn
     */
    function get_position($logi_no)
    {
        $SQL = "SELECT e.position FROM sdb_logisticsmanager_waybill as w LEFT JOIN sdb_logisticsmanager_waybill_extend as e ON w.id=e.waybill_id WHERE w.waybill_number='".$logi_no."'";
        
        $extend = $this->db->selectrow($SQL);
        
        if ($extend) {
            return $extend;
        }
        return false;
    }

    
    /**
     * 保存大头笔信息
     * @param   
     * @return  
     * @access  public
     * @author cyyr24@sina.cn
     */
    function save_position($data)
    {
        $waybillObj =  app::get("logisticsmanager")->model("waybill");
        $logi_no = $data['expno'];
        $waybill_detail = $waybillObj->dump(array('waybill_number'=>$logi_no),'id');
        
        $waybill_id = $waybill_detail['id'];
        $params = array();
        $extend = $this->dump(array('waybill_id'=>$waybill_id));
        if ($extend) {
            $params['id'] = $extend['id'];
        }
        $params['waybill_id'] = $waybill_id;
        $params['position'] = $data['bigchar'];
        if(!empty($params['position']) && $waybill_id){
            $result = $this->save($params);
        }

    }
}