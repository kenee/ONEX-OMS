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


class finance_io_bill_process{

    private $importFiletype = '';
    private $importProcessObject = '';

    /**
     * type
     * @param mixed $importFiletype importFiletype
     * @return mixed 返回值
     */
    public function type($importFiletype = 'normal'){
        $this->importFiletype = $importFiletype;

        if (!class_exists('finance_io_bill_process_'.$importFiletype)) {
            return false;
        }

        $this->importProcessObject = kernel::single('finance_io_bill_process_'.$importFiletype);
        return $this;
    }

    public function structure_import_data(&$mdl,$row,&$format_row=array(),&$result){
        $this->importProcessObject->structure_import_data($mdl,$row,$format_row,$result);
    }

    /**
     * 检查ing_import_data
     * @param mixed $mdl mdl
     * @param mixed $row row
     * @param mixed $result result
     * @return mixed 返回验证结果
     */
    public function checking_import_data(&$mdl,$row,&$result){
        $this->importProcessObject->checking_import_data($mdl,$row,$result);
    }

    /**
     * finish_import_data
     * @param mixed $mdl mdl
     * @param mixed $row row
     * @param mixed $result result
     * @return mixed 返回值
     */
    public function finish_import_data(&$mdl,$row,&$result){
        $this->importProcessObject->finish_import_data($mdl,$row,$result);
    }

    /**
     * 读取到的数据格式化
     *
     * @param Object $mdl MODEL层对象
     * @param Array $row 读取一行
     * @return void
     * @author 
     **/
    public function getSDf(&$mdl,$row,&$mark)
    {
        return $this->importProcessObject->getSDf($mdl,$row,$mark);
    }

}
?>