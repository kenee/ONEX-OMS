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


class eccommon_view_input{

    function input_region($params){
        //$app = app::get($params['app']);
        $regions = app::get('eccommon')->model('regions');
        $package = kernel::single('eccommon_regions_mainland');
        $package = $package->key;
        if($params['required'] == 'true'){
            $req = ' vtype="area"';
        }else{
            $req = ' vtype='.$params['vtype'];
        }

		// region select instance.
		$objRegionsSelect = kernel::single('eccommon_regions_select');
        if(!$params['value']){
            return '<span package="'.$package.'" class="span _x_ipt"'.$req.'><input '. ( $params['id']?' id="'.$params['id'].'"  ':'' ) .' type="hidden" name="'.$params['name'].'" />'.$objRegionsSelect->get_area_select(null,$params).'</span>';
        }else{
            list($package,$region_name,$region_id) = explode(':',$params['value']);
			$arr_region_name = explode("/", $region_name);
			$depth = count($arr_region_name);
            if(!is_numeric($region_id)){
                return '<span package="'.$package.'" class="span _x_ipt"'.$req.'><input type="hidden" name="'.$params['name'].'" />'.$objRegionsSelect->get_area_select(null,$params).'</span>';
            }else{
                $arr_regions = array();
                $ret = '';
                while($region_id && ($region = $regions->dump($region_id,'region_id,local_name,p_region_id'))){
					$params['depth'] = $depth--;
                    array_unshift($arr_regions,$region);
                    if($region_id = $region['p_region_id']){
                        $notice = "-";
                        $data = $objRegionsSelect->get_area_select($region['p_region_id'],$params,$region['region_id']);
                        if(!$data){
                            $notice = "";
                        }
                        $ret = '<span class="x-region-child">&nbsp;'.$notice.'&nbsp'.$objRegionsSelect->get_area_select($region['p_region_id'],$params,$region['region_id']).$ret.'</span>';
                    }else{
                        $ret = '<span package="'.$package.'" class="span _x_ipt"'.$req.'><input type="hidden" value="'.$params['value'].'" name="'.$params['name'].'" />'.$objRegionsSelect->get_area_select(null,$params,$region['region_id']).$ret.'</span>';
                    }
                }
                if(!$ret){
                    $ret = '<span package="'.$package.'" class="span _x_ipt"'.$req.'><input type="hidden" value="" name="'.$params['name'].'" />'.$objRegionsSelect->get_area_select(null,$params,$region['region_id']).'</span>';
                }
                return $ret;
            }
        }
    }
}
