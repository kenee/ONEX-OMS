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
 * 自动确认设置
 *
 * @author hzjsq@msn.com
 * @version 0.1b
 */

class omeauto_config_setting {

    /**
     *
     */
    public function saveAutoCnf($cnf) {

        $cnfString = serialize($cnf);
        app::get('omeauto')->setConf('auto.setting', $cnfString);
    }

    /**
     * 获得当前设置内容
     *
     * @param void
     * @return Array
     */
    function getAutoCnf() {
        $autoCnf = app::get('ome')->getConf('auto.setting');

        if (empty($autoCnf)) {
            return $this->_defaultAutoCnf();
        } else {
            if (!is_array($autoCnf) || empty($autoCnf)) {
                return $this->_defaultAutoCnf();
            } else {
                return $autoCnf;
            }
        }
    }

    /**
     * 获取缺省设置
     *
     * @param void
     * @return Array
     */
    private function _defaultAutoCnf() {

        return array('bufferTime' => '30', 'autoCod' => 'N', 'chkNoPayOrder' => 'Y', 'chkMemo' => 'Y', 'chkCustom' => 'Y', 'chkProduct' => 'N', 'autoDelivery' => 'Y', 'combineMember' => 'N', 'chkShipAddress' => 'N');
    }
}