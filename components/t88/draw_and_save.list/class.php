<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;
use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;
use \T88\Pictures\OrmTable;
use \Bitrix\Main\Loader;

// подключаем родитеьский компонент , чтобы доолнить его функционал

CBitrixComponent::includeComponentClass("t88:draw_and_save");

class Drop_and_save_list extends Drow_and_save
{

    public function setItems(){
        $this->arResult['data'] = OrmTable::GetList()->fetchAll();
    }
    public function executeComponent()
    {
        if ($this->checkModules()) {
            if ($this->startResultCache()) {
               $this->setItems();
                $this->includeComponentTemplate($this->componentPage);
            }
            return $this->arResult;
        }
    }
}