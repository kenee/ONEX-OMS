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

/**
 *  PHPEXECL 处理类
 */

class omecsv_phpexcel
{
    /**
     * @param $data 数据 二维数组
     * @param $fileName 文件名 没有后缀
     * @param $fileType 文件类型
     * @param null $title 标题
     * @param null $path 保存路径
     * @return bool
     * @throws Exception
     */
    public function newExportExcel($data, $fileName, $fileType, $title = null, $path = null)
    {
        //文件名称校验
        try {
            if (!$fileName) {
                throw new \Exception('文件名不能为空');
            }
            
            $fileType = ucfirst(strtolower($fileType));
            //Excel文件类型校验
            $type = ['Xlsx', 'Xls'];
            if (!in_array($fileType, $type)) {
                throw new \Exception('未知文件类型');
            }
            
            $config = [
                'path' => kernel::single('ome_func')->getTmpDir() // xlsx文件保存路径
            ];
            $excel  = new \Vtiful\Kernel\Excel($config);
            $fileTmpName = time().uniqid().rand(10,99).'.xlsx';
            // fileName 会自动创建一个工作表，你可以自定义该工作表名称，工作表名称为可选参数
            $filePath = $excel->fileName($fileTmpName, 'sheet1');
            if($title) {
                $filePath = $filePath->header($title);
            }
            if($data) {
                $filePath = $filePath->data($data);
            }
            $filePath = $filePath->output();
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="' . $fileName . '-' . date('Ymd') . '.xlsx"');
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Cache-Control: max-age=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            if (!empty($path)) {
                $savePath = $path;
            } else {
                $savePath = 'php://output';
            }
            if (copy($filePath, $savePath) === false) {
                // Throw exception
            }
    
            // Delete temporary file
            @unlink($filePath);

            return true;
        } catch (\Exception $e) {
            throw $e;
        }
        return false;
    }
}