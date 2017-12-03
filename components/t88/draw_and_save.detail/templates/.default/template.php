<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if(count($arResult['ITEM'])!=0){?>
    <h2>
        Страница элемента #<?=$arResult['ITEM']['ID']?>
    </h2>
    <a href="<?=$arParams['FOLDER']?><?=str_replace("#ELEMENT_ID#", $arResult['ITEM']['ID'], $arParams['EDIT']);?>">Редактировать</a>
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



