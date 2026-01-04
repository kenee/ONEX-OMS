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

class ediws_filename
{
    private static $_filepath = '';

    public static function set_filepath($type = 'jd_csv')
    {
        $cur_date = date('Ymd');
        $sub_dir = DATA_DIR . '/' . $type . '/' . $cur_date;
       

       if(!is_dir($sub_dir)){
            utils::mkdir_p($sub_dir);
        }
       

        //修改文件夹权限
        chmod($sub_dir, 0777);
        
        self::$_filepath = $sub_dir;
    }

    public static function get_filepath() {
        return self::$_filepath;
    }
    
    /**
     * 获取销售单、售后单上传SAP的文件名
     * 
     * @param $params
     * @return string
     */
    public static function get_sap_sales_filename($params)
    {
        self::set_filepath();
        
        //get
        $ttpos_store = $params['ttpos_store'];
        $bill_type = ($params['bill_type'] ? $params['bill_type'] : 'SO');
        $date = $params['date'];
        $file_sequence = sprintf('%06d', $params['file_page']);
        
        //parts
        $parts = array();
        $parts[] = 'CN'; //中国
        $parts[] = ERP_BRAND; //品牌编码
        $parts[] = $ttpos_store; //TTpos编码
        $parts[] = $bill_type; //单据业务类型(SO：销售单,SR：售后单)
        $parts[] = $date; //日期：年月日时分秒
        $parts[] = $file_sequence; //文件页码
        
        //filename
        $filename = implode('_', $parts);
        $filename = self::$_filepath . '/' . $filename . '.txt';
        
        return $filename;
    }
    
    /**
     * 库存调整单推送SAP文件名称
     * 
     * @param $adjustment_id
     * @return string
     */
    public static function get_sap_iostocklist_filename($params)
    {
        self::set_filepath();
        
        //get
        $file_page = sprintf('%04d', $params['file_page']);
        
        //parts
        $parts = array();
        $parts[] = 'ZLI0552';
        $parts[] = 'CNEC';
        $parts[] = date('Ymd', time());
        $parts[] = date('His', time());
        $parts[] = $file_page;
        
        //filename
        $filename = implode('_', $parts);
        $filename = self::$_filepath . '/' . $filename . '.xml';
        
        return $filename;
    }
    
    /**
     * 库存调整单XML文件中REF_DOC_NO字段值
     * 
     * @param $adjustment_id
     * @return string
     */
    public static function get_iostock_ref_doc_no($params)
    {
        //get
        $file_page = sprintf('%04d', $params['file_page']);
        
        //parts
        $parts = array();
        //$parts[] = 'ZLI0552';
        //$parts[] = 'CNEC';
        //$parts[] = date('Ymd', time());
        $parts[] = date('md', time());
        $parts[] = date('His', time());
        $parts[] = $file_page;
        
        //filename
        $ref_doc_no = implode('_', $parts);
        
        return $ref_doc_no;
    }
}
