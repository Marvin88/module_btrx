<?
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();

//error_reporting(E_ALL);

$data = $_POST['imagedata'];
$filename = $_SERVER['DOCUMENT_ROOT'].'/Screenshot_1.png';
//Need to remove the stuff at the beginning of the string
$data = substr($data, strpos($data, ",")+1);
$data = base64_decode($data);

$imgRes = imagecreatefromstring($data);

if(!$imgRes){
    echo "stage1 - error<br>";
}
else{

    imagepng($imgRes, $filename);
    imagedestroy($imgRes);

    //$arFile = CFile::MakeFileArray($filename);

    $arr_file = Array(
        "name" => $filename,
        "size" => filesize($filename),
        "tmp_name" => $filename,
        "type" => filetype($filename),
        "old_file" => "",
        "del" => "Y",
        "MODULE_ID" => "t88.pictures");
    //print_r($arr_file);
    $fid = CFile::SaveFile($arr_file, "/t88/");
    echo $fid;
}
/*
}*/

