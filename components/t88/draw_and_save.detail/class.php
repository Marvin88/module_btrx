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

class Drop_and_save_detail extends Drow_and_save
{

    public function setItem(){
        $result = OrmTable::getById($this->arParams['ITEM_ID']);
        $row = $result->fetch();
        $this->arResult['ITEM'] = $row;
    }
    public function executeComponent()
    {
        if ($this->checkModules()) {
            if ($this->startResultCache()) {
               $this->setItem();
               $this->includeComponentTemplate($this->componentPage);
            }
            return $this->arResult;
        }
    }
}