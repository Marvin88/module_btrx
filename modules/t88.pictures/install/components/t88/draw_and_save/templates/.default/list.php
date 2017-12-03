<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->IncludeComponent(
    "t88:draw_and_save.list",
    "",
    Array(
        'FOLDER'            => $arResult['FOLDER'],
        'NEW'               => $arResult['URL_TEMPLATES']['new'],
        'EDIT'              => $arResult['URL_TEMPLATES']['edit'],
        'COUNT_PER_PAGE'    => $arResult['COUNT_PER_PAGE'],
        'SLIDER_MODE'       => $arResult['SLIDER_MODE'],
    ),
    $component
);?>
