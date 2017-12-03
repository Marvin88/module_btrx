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
CBitrixComponent::includeComponentClass("t88:draw_and_save");

class Drop_and_save_detail extends Drow_and_save
{
    public function getItem(){
        if($this->arParams['ITEM_ID']!=""){

            $result = OrmTable::getById($this->arParams['ITEM_ID']);
            $row = $result->fetch();
            return $row;
        }
        else{
            ShowError(Loc::getMessage('T88.PICTURES_DETAIL_ID_EMPTY'));
            return false;
        }
    }

    public function setItem($item){
        $this->arResult['ITEM'] = $item;
    }

    public function executeComponent()
    {
        $this->checkModules();
        if ($this->startResultCache()) {


            if($item = $this->getItem()){
                $this->setItem($item);
            }

            $this->includeComponentTemplate($this->componentPage);
        }
        return $this->arResult;
    }

}