<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;
use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;
use \T88\Pictures\OrmTable;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;


class Drow_and_save extends CBitrixComponent
{
    public $arUrlTemplates = array();
    public $componentPage ="";

    public function checkModules(){

        if(!Loader::includeModule("t88.pictures")){
            ShowError(Loc::getMessage('T88_MODULE_NOT_INSTALL'));
            die();
        }
        return true;
    }

    public function getLang(){
        $this->includeComponentLang(basename(__FILE__));
        Loc::loadMessages(__FILE__);
    }

    public function setUrlTemplates(){
        $this->arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($this->arDefaultUrlTemplates404, $this->arParams['SEF_URL_TEMPLATES']);
        return $this->arUrlTemplates;
    }

    public function getComponentPage(){

        $this->componentPage = CComponentEngine::ParseComponentPath($this->arParams['SEF_FOLDER'], $this->setUrlTemplates(), $this->arVariables);

        if(!$this->componentPage)
            $this->componentPage = 'list';

        return $this->componentPage;
    }
    public $arDefaultUrlTemplates404 = array(
        "list" => "list",
        "detail" => "#ELEMENT_ID#/",
        "new" => "new",
        "edit" => "edit/#ELEMENT_ID#/",
    );

    public function executeComponent()
    {
        if($this->checkModules()){

            $arDefaultUrlTemplates404 = array(  // занчения ЧПУ по уолчанию
                "list" => "list/",
                "detail" => "#ELEMENT_ID#/",
                "new" => "new",
                "edit" => "/edit/#ELEMENT_ID#/",
            );

            $arDefaultVariableAliases404 = array();
            $arDefaultVariableAliases = array();

            $arComponentVariables = array(
                "ELEMENT_ID",
            );
            if($this->arParams['SEF_MODE'] == "Y"){
                $arVariables = array();
                //массив шаблонов URL
                $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $this->arParams['SEF_URL_TEMPLATES']);

                $arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $this->arParams['VARIABLE_ALIASES']);

                $componentPage = CComponentEngine::ParseComponentPath(
                    $this->arParams['SEF_FOLDER'],
                    $arUrlTemplates,
                    $arVariables
                );
                if(!$componentPage)
                    $componentPage = 'list';

                CComponentEngine::InitComponentVariables(
                    $componentPage,
                    $arComponentVariables,
                    $arVariableAliases,
                    $arVariables
                );

                $this->arResult = array(
                    "FOLDER" => $this->arParams['SEF_FOLDER'],
                    "URL_TEMPLATES" => $arUrlTemplates,
                    "VARIABLES" => $arVariables,
                    "ALIASES" => $arVariableAliases,
                    "COUNT_PER_PAGE"=> $this->arParams['COUNT_PER_PAGE'],
                    "SLIDER_MODE" => $this->arParams['SLIDER_MODE'],
                );

                if($this->startResultCache())
                {
                    $this->includeComponentTemplate($componentPage);
                }
                return $this->arResult;
            }
        }
    }
}?>