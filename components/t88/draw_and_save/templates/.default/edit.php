<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->IncludeComponent(
    "t88:draw_and_save.edit",
    "",
    Array(
        'ITEM_ID'   => $arResult['VARIABLES']['ELEMENT_ID'],
        'FOLDER'    => $arResult['FOLDER'],
        'NEW'       => $arResult['URL_TEMPLATES']['new'],
        'EDIT'      => $arResult['URL_TEMPLATES']['edit'],
    ),
    $component
);?>
