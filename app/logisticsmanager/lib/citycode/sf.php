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
 * 顺风城市编码
 *
 * @category
 * @package
 * @author chenping<chenping@shopex.cn>
 * @version $Id: Z
 */
class logisticsmanager_citycode_sf
{
    var $setting = array('source' => 'sf-city-code.txt');

    var $province_mapping = array(
        '北京市'      => '北京',
        '上海市'      => '上海',
        '天津市'      => '天津',
        '重庆市'      => '重庆',
        '内蒙古自治区'   => '内蒙古',
        '宁夏回族自治区'  => '宁夏回族',
        '新疆维吾尔自治区' => '新疆维吾尔',
        '西藏自治区'    => '西藏',
        '广西壮族自治区'  => '广西壮族',
    );

    /**
     * 
     *
     * @return void
     * @author 
     **/

    public function __construct($app)
    {
        $this->app = $app;
        $this->db = kernel::database();
    }

    public function install()
    {
        $file = $this->app->app_dir.'/'.$this->setting['source'];
        $basename = basename($file,'.txt');
        if($handle = fopen($file,"r")){
            $i = 0;
            $sql = "INSERT INTO `sdb_logisticsmanager_sfcity_code` (`province`,`city`,`city_crc32`,`city_code`) VALUES ";

            $values = array();
            while ($data = fgets($handle, 1000)){
                if (!$data) continue;

                list($city_code,$province,$city) = explode(',',trim($data));

                // $province = $this->province_mapping[$province] ? $this->province_mapping[$province] : $province;

                $city_crc32 = sprintf('%u',crc32($city));
                $values[] = sprintf('(%s,%s,%s,%s)',$this->db->quote($province),$this->db->quote($city),$this->db->quote($city_crc32),$this->db->quote($city_code));
            }
            if ($values) {
                $sql .= implode(',', $values);
                $this->db->exec($sql);
            }

            fclose($handle);
            return true;
        }else{
            return false;
        }
    }
}