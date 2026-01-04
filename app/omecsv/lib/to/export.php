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


define('PHPEXCEL_ROOT', ROOT_DIR.'/app/omecsv/lib/static');
require_once PHPEXCEL_ROOT.'/PHPExcel.php';
require_once PHPEXCEL_ROOT.'/PHPExcel/IOFactory.php';
class omecsv_to_export extends omecsv_prototype{

    function main(){
        $post = kernel::single('base_component_request')->get_post();
        foreach( kernel::servicelist('omecsv_io') as $aIo ){
            if( $aIo->io_type_name == $post['_io_type'] ){
                $oImportType = $aIo;
                break;
            }
        }

        $oName = substr($post['ctler'],strlen($post['add'].'_mdl_'));
        $model = app::get($post['add'])->model( $oName );

        $model->filter_use_like = true;
        $oImportType->init($model);

        $offset = 0;
        $data = array();
        $filename = $oName;
        if (method_exists($model,'exportName')) {
            $model->exportName($filename,$post['filter']);
        }
        
        //后台导出service
        $obj_services = kernel::servicelist('desktop_background_export');
        if($obj_services){
            foreach($obj_services as $service){
                if(method_exists($service, 'doBackgroundExport')){
                    if($service->doBackgroundExport($post['add'],$oName,$post['filter'])){
                        return true;
                    }
                }
            }
        }

        $offset = 0;
        if( method_exists($model,'fgetlist_'.$_REQUEST['_io_type']) ){
            /** 到处头部 **/
            $oImportType->export_header( $data,$model,$_POST['_export_type'] );
            while( $listFlag = $model->fgetlist_csv($data,$_POST,$offset,$_POST['_export_type']) ){
                $offset++;
            }
            $oImportType->export( $data,$offset,$model,$_POST['_export_type'] );
        }else{
            /** 到处头部 **/
            $oImportType->export_header( $data,$model,$_POST['_export_type'] );
            while( $listFlag = $oImportType->fgetlist($data,$model,$_POST,$offset,$_POST['_export_type']) ){
                $offset++;
                $oImportType->export( $data,$offset,$model,$_POST['_export_type'] );
            }
        }
        $oImportType->finish_export();
        return true;
    }

}
