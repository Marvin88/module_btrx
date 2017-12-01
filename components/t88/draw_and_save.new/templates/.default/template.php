<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(dirname(__FILE__).'\lang\ru\template.php');

//print_r($arResult);

?>

<script src="http://code.jquery.com/jquery-1.5.2.min.js" type="text/javascript" ></script>
<script src="<?=$this->GetFolder()?>/draw_plugin/jquery.jqscribble.js" type="text/javascript"></script>
<script src="<?=$this->GetFolder()?>/draw_plugin/jqscribble.extrabrushes.js" type="text/javascript"></script>

<style>
    .links a {
        padding-left: 10px;
        margin-left: 10px;
        border-left: 1px solid #000;
        text-decoration: none;
        color: #999;
    }
    .links a:first-child {
        padding-left: 0;
        margin-left: 0;
        border-left: none;
    }
    .links a:hover {text-decoration: underline;}
    .column-left {
        display: inline;
        float: left;
    }
    .column-right {
        display: inline;
        float: right;
    }
</style>



<h2>

    Страница добавления рисунка

</h2>
<?if($arResult['SAVE']=="Y"){
    echo Loc::getMessage("SAVEOK");
    ?>
    <a href="<?=$arParams['FOLDER']?><?=$arResult['NEW_ITEM']?>/">Посмотреть новый элемент </a>
    <?
}?>



<div style="overflow: hidden; margin-bottom: 5px;">
    <div class="column-left links">
        <strong>BRUSHES:</strong>
        <a href="#" onclick='$("#test").data("jqScribble").update({brush: BasicBrush});'>Basic</a>
        <a href="#" onclick='$("#test").data("jqScribble").update({brush: LineBrush});'>Line</a>
        <a href="#" onclick='$("#test").data("jqScribble").update({brush: CrossBrush});'>Cross</a>
    </div>
    <div class="column-right links">
        <strong>COLORS:</strong>
        <a href="#" onclick='$("#test").data("jqScribble").update({brushColor: "rgb(0,0,0)"});'>Black</a>
        <a href="#" onclick='$("#test").data("jqScribble").update({brushColor: "rgb(255,0,0)"});'>Red</a>
        <a href="#" onclick='$("#test").data("jqScribble").update({brushColor: "rgb(0,255,0)"});'>Green</a>
        <a href="#" onclick='$("#test").data("jqScribble").update({brushColor: "rgb(0,0,255)"});'>Blue</a>
    </div>
</div>
<canvas id="test" style="border: 1px solid red;"></canvas>
<div class="links" style="margin-top: 5px;">
    <strong>OPTIONS:</strong>
    <a href="#" onclick='addImage();'>Add Image</a>
    <a href="#" onclick='$("#test").data("jqScribble").clear();'>Clear</a>
    <a href="#" onclick='$("#test").data("jqScribble").save();'>Save</a>
    <a href="#" onclick='save();'>Custom Save</a>
</div>
<script type="text/javascript">
    function save()
    {
        $("#test").data("jqScribble").save(function(imageData)
        {
            alert("!!!!");
            //if(confirm("This will write a file using the example image_save.php. Is that cool with you?"))
            //{
                //$.post('<?=$this->GetFolder()?>/draw_plugin/image_save.php', {imagedata: imageData}, function(response)

                $.post('', {imagedata: imageData}, function(response)
                {
                    $('body').append(response);
                });
            //}
        });
    }
    function addImage()
    {
        var img = prompt("Enter the URL of the image.");
        if(img !== '')$("#test").data("jqScribble").update({backgroundImage: img});
    }
    $(document).ready(function()
    {
        $("#test").jqScribble();
    });
</script>


<form action="" method="post" name="NEW_ELEMENT">
    <?=bitrix_sessid_post()?>
    <div class="form_field_group">
        <label for="FILE_ID">Id файла</label>
        <input type="text" name="FILE_ID" value="" placeholder=""/>
    </div>

    <div class="form_field_group">
        <label for="PASSWORD">Пароль доступа</label>
        <input type="text" name="PASSWORD" value="" placeholder=""/>
    </div>
    <input type="hidden" name="SUBMIT" value="Y"/>
    <input type="submit" value="Сохранить"/>
</form>



