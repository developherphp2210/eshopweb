<?php
namespace App\MyClass;

class MyLog {

    private function OpenFile(){
        $filename = date('Y-m-d') . '.txt';
        $string = storage_path() ."/app/public/logs/".$filename;        
        $file = fopen($string, 'a');
        return $file;
    }

    /**
     * type = 0 errore
     * type = 1 successo
     */
    static function WriteLog(string $message,string $type){
        $file = (new self)->OpenFile();
        if ($type == '0'){
            fwrite($file, '[Error ] '.$message.PHP_EOL);
        } else {
            fwrite($file, '[Success ] '.$message.PHP_EOL);
        }
        (new self)->CloseFile($file);

    }

    private function CloseFile($file){
        fclose($file);
    }

};