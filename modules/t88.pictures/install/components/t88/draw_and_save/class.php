<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// $arParams
// $arResult
use \Bitrix\Main;
use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;
use \Bitrix\Main\Localization\Loc as Loc;
use \Bitrix\Main\Loader;
use \T88\Pictures\PicturesTable;



class Drow_and_save extends CBitrixComponent
{
    public $arDefaultUrlTemplates404 = array(
        "list" => "",
        "detail" => "#ELEMENT_ID#/",
        "new" => "",
    );

    public $arDefaultVariableAliases404 = array();
    public $arDefaultVariableAliases    = array();
    public $arVariables                 = array();
    public $arUrlTemplates              = array();
    public $componentPage               = "";
    public $arComponentVariables        = array(
                                            "SECTION_ID",
                                            "SECTION_CODE",
                                            "ELEMENT_ID",
                                            "ELEMENT_CODE",
                                            );
    public function getComponentPage(){
        $this->componentPage = CComponentEngine::ParseComponentPath($this->arParams['SEF_FOLDER'], $this->setUrlTemplates(), $this->arVariables);

        if(!$this->componentPage)
            $this->componentPage = 'list';

        return $this->componentPage;
    }

    public function test()
    {
        return "Hello!";
    }

    public function getLang(){
        $this->includeComponentLang(basename(__FILE__));
        Loc::loadMessages(__FILE__);
    }

    public function setUrlTemplates(){
        $this->arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($this->arDefaultUrlTemplates404, $this->arParams['SEF_URL_TEMPLATES']);
        return $this->arUrlTemplates;
    }

    public function getParams(){



    }

    public function setVariables(){
        $this->arVariables = CComponentEngine::InitComponentVariables($this->componentPage, $this->arComponentVariables,$this->arVariables );
        return $this->arVariables;
        //print_r(CComponentEngine::InitComponentVariables($this->componentPage, $this->arComponentVariables,$this->arVariables ));
    }



    public function executeComponent()
    {
        //print_r($this->getUrlTemplates());
        print_r($this->getComponentPage());
        echo "<br>";

        PicturesTable::add(array(
            'FILEID' => '123123',
            'PASSWORD'=> '123312'
        ));
        $this->arResult['data']  = PicturesTable::GetList()->fetchAll();
        //print_r($this->getVariables());


        if($this->startResultCache())
        {
            $this->arResult["MESS"] = $this->test();
            $this->includeComponentTemplate($this->componentPage);
        }
        return $this->arResult;
    }



}?>