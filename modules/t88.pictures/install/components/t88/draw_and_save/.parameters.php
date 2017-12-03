<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "COUNT_PER_PAGE" => Array(
            "NAME" => GetMessage("COUNT_PER_PAGE"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "6",
            "PARENT" => "",
        ),
        "SLIDER_MODE" => array(
            "PARENT" => "",
            "NAME" => Loc::GetMessage('T88.DISPLAY_MODE'),
            "TYPE" => "CHECKBOX",
            "REFRESH" => "N",
            "MULTIPLE" => "N",
            "DEFAULT" => "",
        ),

        "SEF_MODE" => Array(
            "list" => array(
                "NAME" => Loc::getMessage("LIST_PAGE"),
                "DEFAULT" => "",
                "VARIABLES" => array(),
            ),
            "new" => array(
                "NAME" =>  Loc::getMessage("NEW_ELEMENT"),
                "DEFAULT" => "new/",
                "VARIABLES" => array("NEW"),
            ),
            "detail" => array(
                "NAME" => Loc::getMessage("DETAIL_ELEMENT_PAGE"),
                "DEFAULT" => "#ELEMENT_ID#/",
                "VARIABLES" => array("ELEMENT_ID"),
            ),
            "edit" => array(
                "NAME" => Loc::getMessage("EDIT_ELEMENT_PAGE"),
                "DEFAULT" => "edit/#ELEMENT_ID#/",
                "VARIABLES" => array("EDIT"),
            ),

        ),
    ),
);
?>