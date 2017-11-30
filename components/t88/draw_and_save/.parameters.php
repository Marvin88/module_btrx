<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(

        "SEF_MODE" => Array(
            "list" => array(
                "NAME" => Loc::getMessage("LIST_PAGE"),
                "DEFAULT" => "",
                "VARIABLES" => array(),
            ),
            "new" => array(
                "NAME" =>  Loc::getMessage("NEW_ELEMENT"),
                "DEFAULT" => "",
                "VARIABLES" => array("SECTION_ID"),
            ),
            "detail" => array(
                "NAME" => Loc::getMessage("DETAIL_ELEMENT_PAGE"),
                "DEFAULT" => "#ELEMENT_ID#/",
                "VARIABLES" => array("ELEMENT_ID"),
            ),

        ),
    ),
);
?>