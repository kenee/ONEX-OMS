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


class finance_io_bill_rule{

    private $importFiletype = '';
    private $importRuleObject = '';

    /**
     * type
     * @param mixed $importFiletype importFiletype
     * @return mixed 返回值
     */
    public function type($importFiletype = 'normal'){
        $this->importFiletype = $importFiletype;
        $this->importRuleObject = kernel::single('finance_io_bill_rule_'.$importFiletype);
        return $this;
    }

    /**
     * 获取Params
     * @return mixed 返回结果
     */
    public function getParams(){
        return $this->importRuleObject->getParams();
    }

    /**
     * 获取Title
     * @return mixed 返回结果
     */
    public function getTitle(){
        return $this->importRuleObject->getTitle();
    }

    /**
     * isTitle
     * @param mixed $row row
     * @param mixed $line line
     * @return mixed 返回值
     */
    public function isTitle($row,$line){
        return $this->importRuleObject->isTitle($row,$line);
    }

    /**
     * isFilterLine
     * @param mixed $row row
     * @param mixed $line line
     * @return mixed 返回值
     */
    public function isFilterLine($row,$line){
        return $this->importRuleObject->isFilterLine($row,$line);
    }
}
?>