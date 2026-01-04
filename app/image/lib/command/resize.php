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

class image_command_resize extends base_shell_prototype 
{

    var $command_filesystem = 'filesystem图片重新生成';
    var $command_filesystem_options = array(
            'large'=>array('title'=>'重新生成大图', 'short'=>'l'),
            'middle'=>array('title'=>'重新生成中图', 'short'=>'m'),
            'small'=>array('title'=>'重新生成小图', 'short'=>'s'),
        );
    public function command_filesystem() 
    {
        $options = $this->get_options();
        $imageSet = app::get('image')->getConf('image.set');
        //print_r($imageSet);exit;
        if(isset($options['large'])){
            $flag = 'l_ident';
            $setting = $imageSet['L'];
        }elseif(isset($options['middle'])){
            $flag = 'm_ident';
            $setting = $imageSet['M'];
        }elseif(isset($options['small'])){
            $flag = 's_ident';
            $setting = $imageSet['S'];
        }else{
            kernel::log('Nothing to do for Image Resize');
            exit;
        }
        $pagesize = 100;
        $imgObj = kernel::single('image_clip');
        $imgMdl = app::get('image')->model('image');
        $count = $imgMdl->count(array('storage'=>'filesystem'));
        kernel::log(sprintf('Total %d records', $count));
        for($i=0; $i<$count; $i+=$pagesize){
            $rows = $imgMdl->getList('*', array('storage'=>'filesystem'), $i, $pagesize);
            foreach($rows AS $row){
                $orgfile = PUBLIC_DIR . '/images' . $row['ident'];
                if(empty($row[$flag])){
                    continue;
                }
                $targetfile = PUBLIC_DIR . '/images' . $row[$flag];
                if(file_exists($orgfile) && file_exists($targetfile)){
                    $imgObj->image_resize($imgMdl, $orgfile, $targetfile, $setting['width'], $setting['height']);
                    if($setting['wm_type']!='none'&&($setting['wm_text']||$setting['wm_image'])){
                        image_clip::image_watermark($imgMdl, $targetfile, $setting);
                    }
                    kernel::log(sprintf('%s resize(%d x %d) OK!', $targetfile, $setting['width'], $setting['height']));
                }
            }
            kernel::log(sprintf('%d records Completed!', $i+count($rows)));
        }

    }//End Function
    
    var $command_refreshmodify = '强制刷新图片最新更新时间';
    public function command_refreshmodify() 
    {
        kernel::database()->exec('update sdb_image_image SET last_modified = last_modified + 1');
        kernel::log('Refresh last_modified OK!');
    }//End Function

}//End Class