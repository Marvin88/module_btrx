
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// $arParams
// $arResult
use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;
use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;
use \T88\Pictures\OrmTable;
use \Bitrix\Main\Loader;



class Drow_and_save extends CBitrixComponent
{
    public $arDefaultUrlTemplates404 = array(
        "list" => "",
        "detail" => "#ELEMENT_ID#/",
        "new" => "new",
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
    public function checkModules(){

        if(!Loader::includeModule("t88.pictures")){
            ShowError(Loc::getMessage('T88_MODULE_NOT_INSTALL'));
            return false;
        }
        return true;
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
        if($this->checkModules()){
            //print_r($this->getUrlTemplates());
            //print_r($this->getComponentPage());
            //echo "<br>";

            /*OrmTable::add(array(
                'FILEID' => '123123',
                'PASSWORD'=> '123312'
            ));

            $this->arResult['data']  = OrmTable::GetList()->fetchAll();
            *///print_r($this->getVariables());
            //print_r($this->arResult);

            if($this->startResultCache())
            {
                $this->arResult["MESS"] = $this->test();
                $this->includeComponentTemplate($this->componentPage);
            }
            return $this->arResult;
        }

    }



}?>