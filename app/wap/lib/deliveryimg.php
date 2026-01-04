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

class wap_deliveryimg
{
    /* 获取发货单的图片信息
     * @param intval $delivery_id 发货单id 转换成ome_delivery_id
     * @param string $size 图片尺寸 (L/M/S) 默认为原图
     * @return array 图片信息
     */

    public function uploadImage($delivery_id, $file, $name = null, $watermark = false)
    {
        if (!$delivery_id || !$file) {
            return false;
        }
        $omedeliverys = $this->getomedeliverys($delivery_id);

        $omedelivery_id = $omedeliverys['delivery_id'];
        $imageModel = app::get('image')->model('image');
        return $imageModel->uploadAndAttach(
            $file, 
            'delivery', 
            $omedelivery_id, 
            $name, 
            null,  // 不生成不同尺寸，只保存原图
            $watermark
        );
    }


    /* 获取发货单的图片信息
     * @param intval $delivery_id 发货单id 转换成ome_delivery_id
     * @param string $size 图片尺寸 (L/M/S) 默认为原图
     * @return array 图片信息
     */

    public function getdeliveryImages($delivery_id, $size = null)
    {
        if (!$delivery_id) {
            return [];
        }

        // 使用统一的图片服务
        $imageModel = app::get('image')->model('image');
        $images=$imageModel->getAttachedImages('delivery', $delivery_id, $size);
        $imagelist = [];
        foreach($images as $v){
            $imagelist[] = $v['full_url'];
        }
        return $imagelist;
    }

    
    /**
     * 获取omedeliverys
     * @param mixed $wap_delivery_id ID
     * @return mixed 返回结果
     */
    public function getomedeliverys($wap_delivery_id){
        $deliveryObj = app::get('wap')->model('delivery');
        
        $delivery = $deliveryObj->dump(array('delivery_id' => $wap_delivery_id), 'outer_delivery_bn');
        $outer_delivery_bn = $delivery['outer_delivery_bn'];
        
        $omedeliveryMdl =app::get('ome')->model('delivery');

        $omedeliverys =$omedeliveryMdl->dump(array('delivery_bn'=>$outer_delivery_bn),'delivery_id');
        return $omedeliverys;

    }


     /* 获取发货单的图片信息
     * @param intval $delivery_id 发货单id 转换成ome_delivery_id
     * @param string $size 图片尺寸 (L/M/S) 默认为原图
     * @return array 图片信息
     */

    public function getwapdeliveryImages($delivery_id, $size = null)
    {
        if (!$delivery_id) {
            return [];
        }

        $omedeliverys = $this->getomedeliverys($delivery_id);

        $omedelivery_id = $omedeliverys['delivery_id'];
        // 使用统一的图片服务
        $imageModel = app::get('image')->model('image');
        $images= $imageModel->getAttachedImages('delivery', $omedelivery_id, $size);

        $imagelist = [];
        foreach($images as $v){
            $imagelist[] = $v['full_url'];
        }
        return $imagelist;
    }
}
