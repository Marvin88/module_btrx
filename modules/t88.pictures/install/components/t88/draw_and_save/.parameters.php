<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(

       /* "ORDER_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "Переменная с ID счета",
            "TYPE" => "STRING",
            "DEFAULT" => '={$item}',
        ),
        "DISPLAY_LINK" => array(
            "PARENT" => "BASE",
            "NAME" => "Выводить ссылку",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => '',
        ),
        "LINK_TEXT" => array(
            "PARENT" => "BASE",
            "NAME" => "Текст на ссылке",
            "TYPE" => "STRING",
            "DEFAULT" => '',
        ),*/

        "SEF_MODE" => Array(
            "list" => array(
                "NAME" => Loc::getMessage("LIST_PAGE"),
                "DEFAULT" => "",
                "VARIABLES" => array(),
            ),
            "new" => array(
                "NAME" =>  Loc::getMessage("NEW_ELEMENT"),
                "DEFAULT" => "",
                "VARIABLES" => array(""),
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