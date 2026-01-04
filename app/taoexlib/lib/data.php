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

class taoexlib_data{
    function data_clear(){
        $appname = 'taoexlib';
        $app_dbschema_path = APP_DIR.'/'.$appname.'/dbschema';
        $dbschame_dir = opendir($app_dbschema_path);
         while( $file = readdir($dbschame_dir) ){
              $ext = substr($file, strpos($file,'.php'));
              if ($file != '..' && $file != '.' && $ext == '.php'){
                  $file = substr($file, 0, strpos($file,'.php'));
                  $table_name = 'sdb_'.$appname.'_'.$file;
                  $sql = "truncate table `".$table_name."`;";
                  kernel::database()->exec($sql);                 
                  }
              }
    }
}
?>