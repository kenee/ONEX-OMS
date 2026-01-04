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

class tbo2o_cat_operation
{
    // 应用实例对象
    static private $app='tbo2o';

    // 模型实例
    static private $model;


    // 外部可调用的地区数组
    public $regions;


    // 构造方法
    /**
     * __construct
     * @param mixed $app app
     * @return mixed 返回值
     */
    public function __construct($app)
    {
        if(!isset(self::$model)){
            self::$model = app::get(self::$app)->model('store_cat');
        }
    }

    /**
     * 获取指定parent region id的下级地区数量
     * @params string region id
     * @return int 数量
     */
    private function getChildCount($stcId)
    {
		$cnt = self::$model->count(array('p_stc_id' => intval($stcId)));
		return $cnt;
    }

    /**
     * 得到地区信息 - parent region id， 层级，下级地区
     * @params string region id
     * @return array 指定信息的数组
     */
    public function getRegionById($catId='')
    {
        if ($catId){
			$aTemp = self::$model->getList('stc_id,p_stc_id,cat_name,cat_id,cat_path,cat_grade', array('p_stc_id' => $catId), 0, -1, 'stc_id ASC');
        }else{
			$aTemp = self::$model->getList('stc_id,p_stc_id,cat_name,cat_id,cat_path,cat_grade', array('cat_grade' => '1'), 0, -1, 'stc_id ASC');
        }

        if (is_array($aTemp)&&count($aTemp) > 0)
        {
            foreach($aTemp as $key => $val)
            {
                $aTemp[$key]['p_stc_id']=intval($val['p_stc_id']);
                $aTemp[$key]['step'] = intval(substr_count($val['cat_path'],','))-1;
                $aTemp[$key]['child_count'] = $this->getChildCount($val['cat_id']);
            }
        }

        return $aTemp;
    }

}
