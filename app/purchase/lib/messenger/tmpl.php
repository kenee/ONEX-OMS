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


class purchase_messenger_tmpl{
    
    /**
     * last_modified
     * @param mixed $tplname tplname
     * @return mixed 返回值
     */
    public function last_modified($tplname) 
    {
        $systmpl = app::get('ome')->model('print_tmpl_diy');
       $aRet = $systmpl->getList('*',array('active'=>'true','app'=>'purchase','tmpl_name'=>$tplname));
        if($aRet){
              return $aRet[0]['edittime'];    
        }
        return time();
    }

    /**
     * 获取_file_contents
     * @param mixed $tplname tplname
     * @return mixed 返回结果
     */
    public function get_file_contents($tplname) 
    { 
       $systmpl = app::get('ome')->model('print_tmpl_diy');
       $aRet = $systmpl->getList('*',array('active'=>'true','app'=>'purchase','tmpl_name'=>$tplname));
        if($aRet){
              return $aRet[0]['content'];    
        }
        return null;
        
    }

}
?>