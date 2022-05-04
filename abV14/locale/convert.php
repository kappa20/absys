<?php
$excelPath = dirname(__FILE__)."\\newExcel\\";
$csvPath = dirname(__FILE__)."\\csv\\";
$files = scandir($excelPath);

foreach($files as $f){
    if(strpos($f,".xlsx")!==false || strpos($f,".xls")){
        $fileName = pathinfo($f,PATHINFO_FILENAME);
        $resultPath = $csvPath.$fileName.".csv";
        $command = "tocsv.vbs $excelPath\\$f $resultPath";
        shell_exec($command);
    }
}