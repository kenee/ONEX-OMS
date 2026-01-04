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

class eccommon_platform_address{

    /**
     * sync
     * @param mixed $data 数据
     * @return mixed 返回值
     */
    public function sync($data){
        $shop_id = $data['shop_id'];

        $params = array(

        );
        $rs = kernel::single('erpapi_router_request')->set('shop', $shop_id)->branch_getProvince($params);

        if($rs['rsp'] == 'succ' && $rs['data']){
            $this->save($rs['data']);
        }
    }


    /**
     * 保存
     * @param mixed $data 数据
     * @return mixed 返回操作结果
     */
    public function save($data){

        $regionsObj = app::get('eccommon')->model('platform_regions');
        foreach($data as $v){
            $province_id    = $v['province_id'];
            $province       = $v['province'];

            $regions = $regionsObj->dump(array('shop_type'=>$shop_type,'province_id'=>$province_id),'id,mapping');
            if($regions){
               if($regions['mapping'] == '0'){
                    $local_regions = $this->getLocalRegion($province);
                    if($local_regions){
                        $update_data = array(
                            'mapping'        =>  '1',
                            'local_region_id'=>$local_regions['region_id'],
                        );
                        $regionsObj->update($update_data,array('id'=>$regions['id']));
                    }
               }
            }else{
                $local_regions = $this->getLocalRegion($province);
                $insert_data = array(

                    'province_id'   =>  $province_id,
                    'province'      =>  $province,
                    'shop_type'     =>  $shop_type,

                );
                if($local_regions){
                    $insert_data['local_region_id'] = $local_regions['region_id'];
                    $insert_data['mapping'] = '1';
                }

                $regionsObj->save($insert_data);

            }
        }

    }


   

}


?>