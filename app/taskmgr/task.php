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

class taskmgr_task{

    function post_install($options){
        //添加导出任务需要的文件夹路径,本地缓存目录
        if(!is_dir(DATA_DIR.'/export/cache')){
            utils::mkdir_p(DATA_DIR.'/export/cache');
        }

        //导出本地数据文件目录
        if(!is_dir(DATA_DIR.'/export/file')){
            utils::mkdir_p(DATA_DIR.'/export/file');
        }

        //下载ftp模式的文件本地缓存目录
        if(!is_dir(DATA_DIR.'/export/tmp_local')){
            utils::mkdir_p(DATA_DIR.'/export/tmp_local');
        }

        //上传ftp模式的文件本地缓存目录
        if(!is_dir(DATA_DIR.'/export/tmp_remote')){
            utils::mkdir_p(DATA_DIR.'/export/tmp_remote');
        }
    }

}
