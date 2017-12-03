<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;
use \T88\Pictures\OrmTable;
use \Bitrix\Main\Loader;

// подключаем родитеьский компонент , чтобы доолнить его функционал

CBitrixComponent::includeComponentClass("t88:draw_and_save");

class Drop_and_save_list extends Drow_and_save
{

    public function setItems(){
        /*$this->arResult['ITEMS'] = OrmTable::GetList(array(
            'order' => array('ID' => 'DESC',))
        )->fetchAll();

        */



        $nav = new \Bitrix\Main\UI\PageNavigation("nav-more-items");
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams['COUNT_PER_PAGE'])
            ->initFromUri();

        $this->arResult['ITEMS'] = OrmTable::GetList(
            array(
                'order' => array('ID' => 'DESC',),
                "count_total" => true,
                "offset" => $nav->getOffset(),
                "limit" => $nav->getLimit(),
            )
        );
        $nav->setRecordCount( $this->arResult['ITEMS']->getCount());

        $this->arResult['ITEMS'] = $this->arResult['ITEMS']->fetchAll();
        $this->arResult["NAV_OBJECT"] = $nav;



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