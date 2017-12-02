<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;
use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;
use \T88\Pictures\OrmTable;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
// подключаем родитеьский компонент , чтобы доолнить его функционал

CBitrixComponent::includeComponentClass("t88:draw_and_save");

class Drop_and_save_new extends Drow_and_save
{
    protected $salt = 'asdas1231230)@@)@@)';

    public function addNewItem($data, $pass){

        //$data = $_POST['imagedata'];
        $filename = $_SERVER['DOCUMENT_ROOT'].'/Screenshot_1.png';
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
            if($fid){


                $result = OrmTable::add(array(
                    'FILEID' => $fid,
                    'PASSWORD' => md5($pass."".$this->salt)
                ));

                if ($result->isSuccess())
                {
                    $id = $result->getId();
                    return $id;
                }
                echo "save error";
                return false;
            }
        }


    }
    public function executeComponent()
    {
        if ($this->checkModules()) {
            if ($this->startResultCache()) {
               //$this->setItem();
                if($_POST['imagedata'] != "" && $_POST['pass']!=""){
                    if($id = $this->addNewItem($_POST['imagedata'], $_POST['pass'])){
                        $this->arResult['SAVE']='Y';
                        $this->arResult['NEW_ITEM'] = $id;

                        $GLOBALS['APPLICATION']->RestartBuffer();
                        echo json_encode($this->arResult);
                        die();
                    }
                }

               $this->includeComponentTemplate($this->componentPage);
            }
            return $this->arResult;
        }
    }
}