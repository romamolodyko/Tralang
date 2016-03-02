/**
 * Created by Roma on 20.02.2016.
 */
$(document).ready(initPage());

function initPage(){
    var russiaWord = "";
    var englishWord = "";

    onClickDelete();
    onClickPlay();

    // Получить перевод слова
    $('.show_translate').on('click', function () {
        englishWord = $(".word").val().toLowerCase();
        $.get('https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160125T224254Z.e65448e92af94329.f3a26d05cde4ad6f448cefd8598c707b8d722a5e',
            {
                text: englishWord,
                lang: 'en-ru'
            },
            onAjaxSuccess);
    });

    // Добавить слово в БД
    $('.send').on('click', function () {
        russiaWord = $(this).text();
        $.get('add',
            {
                russiaWord: russiaWord,
                englishWord: englishWord
            }).done(function(data){
                if(data == "false"){
                    $(".alert-danger").css("display", "block");
                    $(".words").css("height", "455px");
                }
                else{
                    $(".alert-success").css("display", "block");
                    $('.table').prepend(data);
                    $(".words").css("height", "455px");
                }
                $(".send").css("display", "none");
                $('.word').val("");
            })
    });
}





