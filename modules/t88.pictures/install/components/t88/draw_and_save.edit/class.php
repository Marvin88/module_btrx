<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;
use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;
use \T88\Pictures\OrmTable;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
Loc::loadMessages(__FILE__);

// подключаем родитеьский компонент
CBitrixComponent::includeComponentClass("t88:draw_and_save.detail");
CBitrixComponent::includeComponentClass("t88:draw_and_save.new");

class Drop_and_save_edit extends Drop_and_save_detail
{
    public function setNeedPassword(){
        $this->arResult['NEED_PASS'] ="Y";
    }
    public function checkAccess($pass, $curPass){


        if (md5($pass."".\Drop_and_save_new::getSalt())== $curPass){

            return true;
        }
        else{
            $this->arResult['PASS_ERROR'] = Loc::getMessage('PASS_ERROR');
            return false;
        }

    }
    public function updateItem($data, $oldFileId, $itemId ){
        // готовим картинку
        $filename = $_SERVER['DOCUMENT_ROOT'].'/Screenshot_1.png'; // временный файл, буфер
        $data = substr($data, strpos($data, ",")+1);
        $data = base64_decode($data);
        $imgRes = imagecreatefromstring($data);
        if(!$imgRes){
            return false;
        }
        else{
            imagepng($imgRes, $filename);
            imagedestroy($imgRes);
            // готовим файл к записи и удаляем старый
            $arr_file = Array(
                "name" => $filename,
                "size" => filesize($filename),
                "tmp_name" => $filename,
                "type" => filetype($filename),
                "old_file" => $oldFileId,
                "del" => "Y",
                "MODULE_ID" => "t88.pictures");
            // сохраняем файл
            $fid = CFile::SaveFile($arr_file, "/t88/");
            if($fid){
                $result = OrmTable::update($itemId, array(
                    'FILEID' => $fid,
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

    // Устанавливаем куки для сравнения во время запроса на обновление
    public function setCookie($itemId, $itemPassMD5){
        $item = array();
        $item['ID'] = $itemId;
        $item['PASS'] = md5($itemPassMD5);
        global $APPLICATION;
        $APPLICATION->set_cookie("item", serialize($item));
    }
// Проверяем установленое значение куки
    public function checkPermByCookie($itemId, $itemPassMD5){
        global $APPLICATION;
        $arrCookie =  unserialize($APPLICATION->get_cookie("item"));
        if($arrCookie['ID'] == $itemId && md5($itemPassMD5) == $arrCookie['PASS']){
            return true;
        }
        return false;
    }


    public function executeComponent()
    {

        if ($this->checkModules()) {
            if ($this->startResultCache()) {
                $item = $this->getItem();
                // проверка пароля . Показываем картинку
                // для блокирования ситуаций подбора пароля необходимо вклчить и настроить "контроль активности" в настройках сайта
                if($_POST['PASSWORD']!="" && $this->checkAccess( $_POST['PASSWORD'], $item['PASSWORD'] )){
                    // Устанавливаем хеш от пароля в куки , для дальнейшей проверки, при обновлении картинки
                    $this->setCookie($item['ID'], $item['PASSWORD']);

                    if($item){
                        $this->setItem($item);
                    }
                }
                // сохранение изображения
                elseif($_POST['imagedata']!="" && $item && $this->checkPermByCookie($item['ID'], $item['PASSWORD'])){

                    if($id = $this->updateItem($_POST['imagedata'], $item['FILEID'], $item['ID'])){
                        $this->arResult['SAVE'] = 'Y';
                        $this->arResult['ITEM_ID'] = $item['ID'];

                        $GLOBALS['APPLICATION']->RestartBuffer();
                        echo json_encode($this->arResult);
                        die();
                    }
                }
                // запрос пароля
                else{
                    $this->setNeedPassword();
                }

                $this->includeComponentTemplate($this->componentPage);
            }
            return $this->arResult;
        }
    }
}