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

class ome_utility_tool{
    function get_temp_dir(){
        if ( !empty($_ENV['TMP']) )
       {
           return realpath( $_ENV['TMP'] );
       }
       else if ( !empty($_ENV['TMPDIR']) )
       {
           return realpath( $_ENV['TMPDIR'] );
       }
       else if ( !empty($_ENV['TEMP']) )
       {
           return realpath( $_ENV['TEMP'] );
       }

       // Detect by creating a temporary file
       else
       {
           // Try to use system's temporary directory
           // as random name shouldn't exist
           $temp_file = tempnam( md5(uniqid(rand(), TRUE)), '' );
           if ( $temp_file )
           {
               $temp_dir = realpath( dirname($temp_file) );
               unlink( $temp_file );
               return $temp_dir;
           }
           else
           {
               return FALSE;
           }
       }
        
    }
}


?>