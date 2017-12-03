<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->SetTitle("Страница элемента #".$arResult['ITEM']['ID']);

use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);

if(count($arResult['ITEM'])!=0){?>
    <a class="action_btn" href="<?=$arParams['FOLDER']?>"><?=Loc::getMessage('T88.BACK_TO_LIST')?></a>
    <a class="action_btn" href="<?=$arParams['FOLDER']?><?=str_replace("#ELEMENT_ID#", $arResult['ITEM']['ID'], $arParams['EDIT']);?>"><?=Loc::getMessage('T88.EDIT')?></a>
    <div style="clear:both;"></div>
<?

   $img = CFile::GetPath($arResult['ITEM']['FILEID']);
   ?>
    <img src="<?=$img?>"/>


    <?

}
else{
    echo "Элемента #".$arParams['ITEM_ID']." не существует";
}


?>



