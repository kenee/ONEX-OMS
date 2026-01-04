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
 * 基础物料处理类
 *
 * @author <chenping@shopex.cn>
 * @time 2020-11-18T19:56:04+08:00
 */
class erpapi_front_response_process_material
{
    /**
     *
     *
     * @return void
     * @author
     **/

    public function get($filter)
    {
        $bmMdl    = app::get('material')->model('basic_material');
        $bmExtMdl = app::get('material')->model('basic_material_ext');
        $catMdl   = app::get('material')->model('basic_material_cat');
        $brandMdl = app::get('ome')->model('brand');

        $bm = $bmMdl->db_dump(array('material_bn' => $filter['bn']));
        if (!$bm) {
            return array('rsp' => 'succ', 'data' => array());
        }

        $bm_ext = $bmExtMdl->db_dump(array('bm_id' => $bm['bm_id']));
        $cat    = $catMdl->db_dump(array('cat_id' => $bm['cat_id']));
        $brand  = $brandMdl->db_dump(array('brand_id' => $bm_ext['brand_id']));

        $data = array('material' => array(
            'name'           => $bm['material_name'],
            'bn'             => $bm['material_bn'],
            'spu'            => $bm['material_spu'],
            'type'           => $bm['type'],
            'unit'           => $bm_ext['unit'],
            'specifications' => $bm_ext['specifications'],
            'unit'           => $bm_ext['unit'],
            'cat_name'       => $cat['cat_name'],
            'brand_name'     => $brand['brand_name'],
        ));

        return array('rsp' => 'succ', 'data' => $data);
    }

}
