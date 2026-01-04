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


class image_rebuild{
    function run(&$cursor_id,$params){
          //每次最多处理2个
        $limit = 2;
        $model = app::get('image')->model('image');
        $db = kernel::database();
        if($params['filter']['image_id']=='_ALL_'||$params['filter']['image_id']=='_ALL_'){
            unset($params['filter']['image_id']);
        }
        $where = $model->_filter($params['filter']);
        $where .= ' and last_modified<='.$params['queue_time'];
        $rows = $db->select('select image_id from sdb_image_image where '.$where.' order by last_modified desc limit '.$limit);
        foreach($rows as $r){

            $model->rebuild($r['image_id'],$params['size'],$params['watermark']);

        }
        $r = $db->selectrow('select count(*) as c from sdb_image_image where '.$where);
        return $r['c'];

    }
}
