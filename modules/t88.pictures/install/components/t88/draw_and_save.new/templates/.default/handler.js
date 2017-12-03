function beforeSave(event){
    event.preventDefault();
    $(document).find('.js-password').addClass('active');
}

function save(event)
{
    event.preventDefault();
    $("#test").data("jqScribble").save(function(imageData){

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

    });
}

$(document).ready(function(){
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
    });

    $('.js-apply_pass').on('click', function(e) {
        $(this).parent().parent().find('.js-close_popup').click();

        setTimeout(function () {
            save(e);
        },200);
    });
});