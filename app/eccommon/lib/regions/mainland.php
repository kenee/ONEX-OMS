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


class eccommon_regions_mainland
{
    var $name = '中国地区';
    var $key = 'mainland';
    var $setting = array('desc' => '系统默认为中国地区设置，包括港、澳、台地区。',
                       'maxdepth' => 3,
                       'source' => 'region-mainland.txt');

    function __construct($app){
        $this->app = $app;
        $this->db = kernel::database();
    }

    function install(){
        $file = $this->app->app_dir.'/'.$this->setting['source'];
        $basename = basename($file,'.txt');
        if($handle = fopen($file,"r")){
            $i = 0;
            $sql = "INSERT INTO `sdb_eccommon_regions` (`region_id`, `package`, `p_region_id`,`region_path`,`region_grade`, `local_name`, `p_1`, `p_2`,`haschild`) VALUES ";
            while ($data = fgets($handle, 1000)){
                $data = trim($data);
                if(substr($data, -2) == '::'){
                    if($aSql){
                        $sqlInsert = $sql.implode(',', $aSql).";";
                        if(!$this->db->exec($sqlInsert)){
                            trigger_error($this->db->errorinfo(),E_USER_ERROR);
                            return false;
                        }
                        unset($path);
                    }
                    $i++;
                    $path[]=$i;
                    $regionPath=",".implode(",",$path).",";
                    $aSql = array();
                    $aTmp = explode('::', $data);
                    $aSql[] = "(".$i.", '{$this->key}', NULL, '".$regionPath."', '".count($path)."', '".$aTmp[0]."', NULL, NULL,1)";
                    $f_pid = $i;
                }else{
                    if(strstr($data, ':')){
                        $i++;
                        $aTmp = explode(':', $data);
                        unset($sPath);
                        $sPath[]=$f_pid;
                        $sPath[]=$i;
                        $regionPath=",".implode(",",$sPath).",";
                        if(trim($aTmp[1])){
                            $aSql[] = "(".$i.", '{$this->key}', ".intval($f_pid).", '".$regionPath."', '".count($sPath)."', '".$aTmp[0]."', NULL, NULL,1)";
                        }else{
                            $aSql[] = "(".$i.", '{$this->key}', ".intval($f_pid).", '".$regionPath."', '".count($sPath)."', '".$aTmp[0]."', NULL, NULL,0)";
                        }
                        if(trim($aTmp[1])){
                            $pid = $i;
                            $aTmp = explode(',', trim($aTmp[1]));
                            foreach($aTmp as $v){
                                $i++;
                                $tmpPath=$regionPath.$i.",";
                                $grade = count(explode(",",$tmpPath))-2;
                                $aSql[] = "(".$i.", '{$this->key}', ".intval($pid).", '".$tmpPath."', '".$grade."', '".$v."', NULL, NULL,0)";
                            }
                        }
                    }elseif($data){
                        $i++;
                        $tmpPath=$regionPath.$i.",";
                        $grade = count(explode(",",$tmpPath))-2;
                        $aSql[] = "(".$i.", '{$this->key}', ".intval($f_pid).", '".$tmpPath."','".$grade."','".$data."', NULL, NULL,0)";
                    }
                }
            }
            fclose($handle);
            return true;
        }else{
            return false;
        }
    }
}
