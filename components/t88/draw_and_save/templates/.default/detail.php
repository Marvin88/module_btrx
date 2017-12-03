<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->IncludeComponent(
    "t88:draw_and_save.detail",
    "",
    Array(
        'ITEM_ID'   =>$arResult['VARIABLES']['ELEMENT_ID'],
        'FOLDER'    =>$arResult['FOLDER'],
        'EDIT'       => $arResult['URL_TEMPLATES']['edit'],
        'NEW'       => $arResult['URL_TEMPLATES']['new'],
    ),
    $component
);?>
