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


class desktop_finder_builder_customcols extends desktop_finder_builder_prototype{

    function main(){
        $customcolsMdl = app::get('desktop')->model('customcols');

        if($_POST['cols']){

            // 验证入参
            foreach($_POST['cols'] as $k=>$v){
                // $v['col_key']只能是字母、数字、下划线
                if(!preg_match('/^[a-zA-Z0-9_]+$/', $v['col_key'])){
                    header('Content-Type:text/jcmd; charset=utf-8');
                    echo '{error:"保存错误,原因:字段名称【'.$v['col_key'].'】只能是字母、数字、下划线",_:null}';
                    exit;
                }

                // $v['col_name']只能是中文、英文、数字、下划线
                if(!preg_match('/^[\p{Han}a-zA-Z0-9_\(\)\（\）]+$/u', $v['col_name'])){
                    header('Content-Type:text/jcmd; charset=utf-8');
                    echo '{error:"保存错误,原因:字段描述【'.$v['col_name'].'】只能是中文、英文、数字、下划线",_:null}';
                    exit;
                }
            }

            $table_name = $this->object->table_name(1);

            $columns  = $this->object->_columns();
            $column_keys = array_keys($columns);

            $col_keys = array_column($_POST['cols'],'col_key');

            $intersection = array_intersect($col_keys, $column_keys);
            //通用默认判断
            if($intersection){
                $msg = '自定义列:'.implode(',',$intersection).'已存在';
                header('Content-Type:text/jcmd; charset=utf-8');
                echo '{error:"保存错误,原因:'.$msg.'",_:null}';
                exit;
              
            }
            if (method_exists($this->object, 'checkCustomcols')){

                list($rs,$msg) = $this->object->checkCustomcols($_POST['cols']);
                if(!$rs){
                    header('Content-Type:text/jcmd; charset=utf-8');
                    echo '{error:"保存错误,原因:'.$msg.'",_:null}';
                    exit;
                }
            }
            
            foreach($_POST['cols'] as $k=>$v){

                $v['tbl_name'] = $table_name;

                $customcolsMdl->save($v);
            }

            header('Content-Type:text/jcmd; charset=utf-8');
            echo '{success:"'.app::get('desktop')->_('设置成功').'"}';    
        }else{

           
            $render = app::get('desktop')->render();

            $render->pagedata['cols'] = $customcolsMdl->getList('*',array('tbl_name'=>$this->object->table_name(1)));

            echo $render->fetch('common/customcols.html');
        }
    }
}