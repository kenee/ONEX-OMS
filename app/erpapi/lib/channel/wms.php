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
 * WMS
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class erpapi_channel_wms extends erpapi_channel_abstract
{
    public $wms;

    private static $wms_mapping = array(
        'jd_wms'       => '360buy',
        'sf_wms'       => 'sf',
        'flux_wms'     => 'flux',
        '360buy'       => 'jd',
        'jd_wms_cloud' => 'jd',
        'suning_wms'   => 'suning',
        'kepler'       => 'yjdf',
    );

    /**
     * 初始化
     * @param mixed $node_id ID
     * @param mixed $channel_id ID
     * @return mixed 返回值
     */

    public function init($node_id, $channel_id)
    {
        $wmsModel = app::get('channel')->model('channel');

        $filter                 = $channel_id ? array('channel_id' => $channel_id) : array('node_id' => $node_id);
        $filter['channel_type'] = 'wms';
        $wms                    = $wmsModel->dump($filter);

        if (!$wms) {
            return false;
        }

        $adapterModel = app::get('channel')->model('adapter');
        $adapter      = $adapterModel->dump(array('channel_id' => $wms['channel_id']));

        $adapter['config'] = @unserialize($adapter['config']);

        $wms['adapter'] = $adapter;
        $wms['config'] = @unserialize($wms['config']);
        $this->wms = $wms;
        $this->channel = $wms;

        if ($adapter['adapter'] == 'selfwms') {
            $this->__adapter  = '';
            $this->__platform = 'selfwms';
        } elseif ($adapter['adapter'] == 'wap') {
            $this->__adapter  = '';
            $this->__platform = 'wap';
        } elseif ($adapter['adapter'] == 'ilcwms') {
            $this->__adapter  = '';
            $this->__platform = 'ftp';
        } elseif ($adapter['adapter'] == 'mixturewms') {
            $this->__adapter  = '';
            $this->__platform = 'mixture';
        } elseif ('wms' == substr($adapter['adapter'], -3)) {
            $this->__adapter  = substr($adapter['adapter'], 0, -3);
            $this->__platform = $wms['addon']['business_type'] ?: (isset(self::$wms_mapping[$wms['node_type']]) ? self::$wms_mapping[$wms['node_type']] : $wms['node_type']);
        }

        return true;
    }
}
