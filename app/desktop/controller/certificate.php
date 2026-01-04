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


class desktop_ctl_certificate extends desktop_controller{

    function index(){

        $this->Certi = base_certificate::get('certificate_id');
        $this->Token = base_certificate::get('token');
        if(empty($this->Certi) ||empty($this->Token)){
            $this->pagedata['license']=false;
        }else{
            $this->pagedata['license']=true;
        }
        $this->pagedata['certi_id']=$this->Certi;
        $this->pagedata['debug']=false;

        $this->page('certificate.html');
    }

    function download(){
        header("Content-type:application/octet-stream;charset=utf-8");
        header("Content-Type: application/force-download");
        header("Cache-control: private");
        $this->fileName = 'CERTIFICATE.CER';
        header("Content-Disposition:filename=".$this->fileName);

        $this->Certi = base_certificate::get('certificate_id');
        $this->Token = base_certificate::get('token');
        echo $this->Certi;
        echo '|||';
        echo $this->Token;
    }
    function delete(){
        $this->begin();
        base_certificate::del_certificate();
        $this->end();
    }

}

