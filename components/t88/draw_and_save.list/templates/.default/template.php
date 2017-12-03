<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<script>
    $(document).ready(function(){
        $('.pictures_slider').bxSlider({
            slideWidth: 200,
            minSlides: 2,
            maxSlides: 3,
            moveSlides: 1,
        });
    });
</script

<?

echo $arParams['COUNT_PER_PAGE']."<br>";


if(count($arResult['ITEMS'])> 0){
    ?>
    <h2>Список элементов</h2>
    <a style=" -webkit-appearance: button; padding: 5px 5px;" href="<?=$arParams['FOLDER']?><?=$arParams['NEW']?>">Добавить новый</a>

    <hr>
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
    Все ждут Вашего шедевра!
    <a style=" -webkit-appearance: button; padding: 5px 5px;" href="<?=$arParams['FOLDER']?><?=$arParams['NEW']?>">Нарисовать</a>
    <?
}

?>
<style>
    .pictures_list a{
        display: inline-block;
        width: 50%;
        float: left;
        text-align: center;
    }
    .pictures_list a img{
        display: inline-block;
    }
</style>



