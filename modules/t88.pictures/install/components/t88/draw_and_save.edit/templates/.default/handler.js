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
                pass: "",
            },
            success: function(msg) {
                if(msg.SAVE=="Y"){
                    attr = $(document).find('.js-response').find('a').attr('href');
                    $(document).find('.js-response').find('a.js-detail_link').attr('href', attr+""+msg.ITEM_ID+"/");// ссылка на элемент
                    $(document).find('.js-response').addClass('active');

                }
                else{
                    alert("Ошибка");
                }

            }
        });
    });
}
