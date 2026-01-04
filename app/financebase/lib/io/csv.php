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

class financebase_io_csv extends financebase_abstract_io{

    /**
     * 获取Info
     * @param mixed $file file
     * @param mixed $sheet sheet
     * @return mixed 返回结果
     */
    public function getInfo($file='',$sheet=0){
    	if(!file_exists($file)) return 0;
    	$splObject = new SplFileObject($file, 'rb');
    	$splObject->seek(filesize($file));
  		return array('row'=>$splObject->key()+1,'column'=>0);
    }

    /**
     * 获取Data
     * @param mixed $file file
     * @param mixed $sheet sheet
     * @param mixed $length length
     * @param mixed $start start
     * @param mixed $compatible_csv compatible_csv
     * @return mixed 返回结果
     */
    public function getData($file='',$sheet = 0,$length=0,$start=0,$compatible_csv = true){

    	if(!file_exists($file)) return array();
    	$splObject = new SplFileObject($file, 'rb');

        $start = ($start < 0) ? 0 : $start; 
        if($length < 0)
        {
            $file_info = $this->getInfo($file);
            $length = $file_info['row'] - $start - 1;
        }
        $this->data = array(); 
        $splObject->seek($start); 
        while ($length-- && !$splObject->eof()) { 
            $current = $splObject->current();//current方法不会跳行 

            $encode = mb_detect_encoding($current, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
            if('UTF-8' != $encode) $current = mb_convert_encoding($current, 'UTF-8', $encode);
            $this->data[]=str_getcsv($current);//再转成数组 
            $splObject->next(); 

            $this->writeData(false,false);
        } 
        $this->writeData(true,false);
        return $this->data; 
    }
}