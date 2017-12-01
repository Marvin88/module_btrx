<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if(count($arResult['ITEMS']!=0)){
    ?>
    <h2>Список элементов</h2>
    <a style=" -webkit-appearance: button; padding: 5px 5px;" href="<?=$arParams['FOLDER']?><?=$arParams['NEW']?>">Добавить новый</a>

    <hr>
    <?
    foreach ($arResult['ITEMS'] as $ITEM){?>
      <div class="list_item">
          <span><?=$ITEM['FILEID']?></span><br>
          <span><?=$ITEM['PASSWORD']?></span><br>
          <a href="<?=$arParams['FOLDER']?><?=$ITEM['ID']?>/">Посмотреть</a>
      </div>

    <?}
}

?>



