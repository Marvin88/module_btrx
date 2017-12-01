<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if(count($arResult['ITEM'])!=0){?>
    <h2>
        Страница элемента #<?=$arResult['ITEM']['ID']?>
    </h2>
<?
    echo "<pre>";
    print_r($arResult);
    echo "</pre>";


   $img = CFile::GetPath($arResult['ITEM']['FILEID']);
   ?>
    <img src="<?=$img?>"/>
    <?

}
else{
    echo "Элемента #".$arParams['ITEM_ID']." не существует";
}


?>



