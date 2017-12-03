<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>



<?$this->addExternalJS("https://code.jquery.com/jquery-3.2.1.min.js");?>

<?$this->addExternalJS($this->getFolder()."/handler.js");?>
<?$this->addExternalCss($this->getFolder()."/styles.css");?>



<?
$APPLICATION->SetTitle("Список элементов");

if($arResult['ITEMS'][0]){?>

    <a class="action_btn" href="<?=$arParams['FOLDER']?><?=$arParams['NEW']?>"><?=Loc::getMessage('T88.ADD_NEW')?></a>

 <?if($arParams['SLIDER_MODE']=="Y"){  // Режим слайдера?>

    <div class="pictures_slider" >
        <?
        foreach ($arResult['ITEMS'] as $ITEM){?>

               <a href="<?=$arParams['FOLDER']?><?=$ITEM['ID']?>/" >
                    <img width="200px" src="<?=CFile::GetPath($ITEM['FILEID'])?>" />
               </a>

        <?}?>
    </div>

   <?}
   else{ // Режим списка ?>
       <div class="pictures_list" >
           <?
           foreach ($arResult['ITEMS'] as $ITEM){?>

               <a href="<?=$arParams['FOLDER']?><?=$ITEM['ID']?>/" style="display: block">
                   <img width="200px" src="<?=CFile::GetPath($ITEM['FILEID'])?>" />
               </a>

           <?}?>
           <div style="clear: both"></div>
       </div>
       <?
       $APPLICATION->IncludeComponent(
           "bitrix:main.pagenavigation",
           "",
           array(
               "NAV_OBJECT" => $arResult['NAV_OBJECT'],
               "SEF_MODE" => "Y",
           ),
           false
       );
       ?>
   <?}
}else{?>
    <?=Loc::getMessage('T88.ADD_FIRST')?>
    <a class="action_btn" href="<?=$arParams['FOLDER']?><?=$arParams['NEW']?>"><?=Loc::getMessage('T88.DRAW_NEW')?></a>
    <?
}
?>




