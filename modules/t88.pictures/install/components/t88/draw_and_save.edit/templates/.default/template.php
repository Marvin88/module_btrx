<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>

<?$this->addExternalJS("http://code.jquery.com/jquery-1.5.2.min.js");?>
<?$this->addExternalJS($this->GetFolder()."/draw_plugin/jquery.jqscribble.js");?>
<?$this->addExternalJS($this->GetFolder()."/draw_plugin/jqscribble.extrabrushes.js");?>
<?$this->addExternalJS($this->getFolder()."/handler.js");?>
<?$this->addExternalCss($this->getFolder()."/styles.css");?>

<?
$APPLICATION->SetTitle("Страница редактирования рисунка");
?>
<a class="action_btn" href="<?=$arParams['FOLDER']?>"><?=Loc::getMessage('T88.BACK_TO_LIST')?></a>
<?if($arResult['PASS_ERROR']!=""):?>
    <p style="color: red"><?=$arResult['PASS_ERROR'];?></p>
<?endif;?>
<?if($arResult['NEED_PASS']=="Y"){?>
    <p class="form_note">
        <?=Loc::getMessage("PASS_NEED_TEXT"); ?>
    </p>
    <form method="POST" name="pass" >
        <?=bitrix_sessid_post()?>
        <input type="password" name="PASSWORD"/>
        <input type="submit" value="ok"/>
    </form>
<?}
else{?>
    <div style="overflow: hidden; margin-bottom: 5px;"></div>
    <div style="width: 800px; height: 600px">
        <canvas id="test" style="border: 1px dashed grey; cursor: crosshair; " ></canvas>
    </div>
    <div class="links" style="margin-top: 5px;">

        <a class="action_btn" href="javascript:void(0);" onclick='$("#test").data("jqScribble").clear();'><?=Loc::getMessage('T88.CLEAR')?></a>
        <a class="action_btn" href="#" onclick='save(event);'><?=Loc::getMessage('T88.SAVE')?></a>

    </div>
<?}?>

<div class="js-response popup_window">
    <img class="js-close_popup" src="<?=$this->GetFolder()?>/img/close.png"/>
    <div class="top_block">
        <span class="header_message">Успех!</span>
        <?=Loc::getMessage("EDITOK"); ?>
    </div>
    <div class="bottom_block">
        <a class="js-detail_link" href="<?=$arParams['FOLDER']?>">Страница элемента </a>
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
<?// вывод текущего изображения?>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#test").jqScribble();
        // добавляем рисунок в область редактирования
        var can = document.getElementById('test');
        var ctx = can.getContext('2d');
        var img = new Image();
        img.onload = function() {
            ctx.drawImage(img, 0, 0);
        }
        img.src = "<?=CFile::GetPath($arResult['ITEM']['FILEID'])?>";
        drawing = new Image();
        drawing.src = "draw.png"; // can also be a remote URL e.g. http://
        drawing.onload = function() {
            context.drawImage(drawing,0,0);
        };
    });
</script>