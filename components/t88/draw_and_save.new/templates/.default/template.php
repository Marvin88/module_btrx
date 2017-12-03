<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->SetTitle("Новый рисунок");

use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);

$this->addExternalJS("http://code.jquery.com/jquery-1.7.min.js");
$this->addExternalJS($this->GetFolder()."/draw_plugin/jquery.jqscribble.js");
$this->addExternalJS($this->GetFolder()."/draw_plugin/jqscribble.extrabrushes.js");
$this->addExternalJS($this->getFolder()."/handler.js");
$this->addExternalCss($this->getFolder()."/styles.css");
?>


<a class="action_btn" href="<?=$arParams['FOLDER']?>"><?=Loc::getMessage('T88.BACK_TO_LIST')?></a>
<div style="overflow: hidden; margin-bottom: 5px;"></div>
<div style="width: 800px; height: 600px">
    <canvas id="test" style="border: 1px dashed grey; cursor: crosshair; " ></canvas>
</div>
<div class="links" style="margin-top: 5px;">

    <a class="action_btn" href="javascript:void(0);" onclick='$("#test").data("jqScribble").clear();'>Очистить</a>
    <a class="action_btn" href="#" onclick='beforeSave(event);'>Сохранить</a>

</div>

<div class="js-response popup_window">
    <img class="js-close_popup" src="<?=$this->GetFolder()?>/img/close.png"/>
    <div class="top_block">
        <span class="header_message">Успех!</span>
        <?=Loc::getMessage("SAVEOK"); ?>
    </div>
    <div class="bottom_block">
        <a class="js-detail_link" href="<?=$arParams['FOLDER']?>">Посмотреть новый элемент </a>
        <br><br>
        <a href="<?=$arParams['FOLDER']?>">Список рисунков</a>
    </div>
</div>

<div class="js-password popup_window">
    <img class="js-close_popup" src="<?=$this->GetFolder()?>/img/close.png"/>
    <div class="top_block">
        <span class="header_message">Отлично!</span>
        <?=Loc::getMessage("SETPASSWORD");?>
        <input class="js-password_field" type="password" name="PASSWORD"/>
    </div>
    <div class="bottom_block">
        <a class="js-apply_pass" disabled="disabled" href="javascript:void(0);">Сохранить</a>
    </div>
</div>
