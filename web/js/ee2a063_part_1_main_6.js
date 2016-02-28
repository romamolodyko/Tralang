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


function onClickDelete(){
    $('.delete-word').on('click', function(){
        var idWord = $(this).attr("data-word-id");
        var self = this;
        $.get('delete',
            {
                id : idWord
            }
        ).done(function(data){
                if(data == "true"){
                    $(self).closest('tr').remove();
                }
                else{
                    $(".alert-danger").val("The word is not removed(");
                    $(".alert-danger").css("display", "block");
                }
            })
    })
}

function onClickPlay(){
    $('.play').on('click', function(){
        var r = $(this).closest('tr').first().text().split(' - '), s = "";
        s = r[0].replace(/\n\s+/, "");
        playWord(s);
    });
}



