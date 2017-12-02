<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(dirname(__FILE__).'\lang\ru\template.php');

print_r($arResult);

?>

<script src="http://code.jquery.com/jquery-1.7.min.js" type="text/javascript" ></script>

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

<div style="overflow: hidden; margin-bottom: 5px;">

</div>
<div style="width: 800px; height: 600px">
    <canvas id="test" style="border: 1px dashed grey; cursor: crosshair; " ></canvas>
</div>
<div class="links" style="margin-top: 5px;">

    <a href="javascript:void(0);" onclick='$("#test").data("jqScribble").clear();'>Очистить</a>
    <a href="#" onclick='beforeSave(event);'>Сохранить</a>

</div>

<script type="text/javascript">
    function beforeSave(event){
        event.preventDefault();
        //$(document).find('.js-password').find('a.js-detail_link').attr('href', attr+""+msg.NEW_ITEM+"/");
        $(document).find('.js-password').addClass('active');

    }

    function save(event)
    {
        event.preventDefault();
        $("#test").data("jqScribble").save(function(imageData)
        {

            $.ajax({
                type: "POST",
                url: "",
                dataType: "json",
                data: {
                    imagedata: imageData,
                    pass: $('.js-password_field').val(),
                },
                success: function(msg) {
                    if(msg.SAVE=="Y"){
                       // alert('Сохранено');
                        attr = $(document).find('.js-response').find('a').attr('href');
                        $(document).find('.js-response').find('a.js-detail_link').attr('href', attr+""+msg.NEW_ITEM+"/");
                        $(document).find('.js-response').addClass('active');

                    }
                    else{
                        alert("Ошибка");
                    }

                }
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

        $('.js-close_popup').click( function(){
            $(this).parent().removeClass('active');

            if($(this).parent().hasClass('js-response')){
                location.reload();
            }

        });


    $('.js-password_field').on('input',function(e){
        length =($(this).val().length);
        console.log(length);
        if(length>2){
            $('.js-apply_pass').attr('disabled',false);
        }
        else{
            $('.js-apply_pass').attr('disabled',true);
        }
    })


        $('.js-apply_pass').on('click', function(e) {
            $(this).parent().parent().find('.js-close_popup').click();

            setTimeout(function () {
                save(e);
            },200);


        })
        /*$('.js-apply_pass').click( function(){
            pass = $(this).val();
            if(pass.length<=2){
                $(this).addClass('error_field');
            }
        });*/


    });
</script>

<!--
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
-->

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


<style>
    .popup_window.active{
        opacity: 1;
        position: absolute;
        display: block;
        top:50%;
        transition: all 0.8s;
    }
    .popup_window{
        opacity: 0;
        position: absolute;
        top:-1150%;
        left: 50%;
        margin-left: -150px;
        width: 300px;
        -webkit-box-shadow: -2px 6px 81px -10px rgba(0,0,0,0.75);
        -moz-box-shadow: -2px 6px 81px -10px rgba(0,0,0,0.75);
        box-shadow: -2px 6px 81px -10px rgba(0,0,0,0.75);

        transition: all 0.8s;
    }
    .popup_window .top_block{
        background-color: #f6f6f6;
        padding-top: 40px;
        padding-bottom: 23px;
        text-align: center;
    }
    .popup_window .top_block input{
        margin-top: 14px;
    }
    .popup_window .top_block b{
        display: inline-block;
        width: 100%;
    }
    .popup_window .bottom_block{
        padding-top: 30px;
        padding-bottom: 30px;
        background-color: #7dbaab;
        text-align: center;
    }
    .popup_window .bottom_block a{
        text-decoration: none;
        background: #405661;
        line-height: 40px;
        display: inline;
        display: inline-block;
        padding-right: 20px;
        padding-left: 20px;
        color: #f6f6f6;
        transition: all 0.4s;
    }
    .popup_window .bottom_block a:hover{
        -webkit-box-shadow: -2px 6px 81px -10px rgba(0,0,0,0.75);
        -moz-box-shadow: -2px 6px 81px -10px rgba(0,0,0,0.75);
        box-shadow: -2px 6px 81px -10px rgba(0,0,0,0.75);
        transition: all 0.4s;
    }
    .header_message {
        font-size: 28px;
        text-align: center;
        font-family: sans-serif;
        display: inline-block;
        width: 100%;
        display: inline-block;
        padding-bottom: 10px;
    }
    .js-close_popup{
        width: 24px;
        position: absolute;
        right: 4px;
        top: 4px;
        opacity: 0.2;
        cursor: pointer;
    }
    .js-apply_pass[disabled="disabled"]{
        opacity: 0.3;
    }

</style>

