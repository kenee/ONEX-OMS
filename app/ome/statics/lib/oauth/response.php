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

class oauth2_response extends oauth2 {

    function __construct($config){
        #parent::__construct($config);
    }

    public function success($data)
    {
        $r = array(
            'status' => 'success',
            'data' => $data,
        );
        return json_encode($r);
    }

    public function fail($code, $data)
    {
        $r = array(
            'status' => 'error',
            'code' => $code,
            'data' => $data,
        );
        return json_encode($r);
    }


}
