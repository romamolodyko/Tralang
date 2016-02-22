/**
 * Created by Roma on 20.02.2016.
 */
$(document).ready(initPage());

function initPage(){
    var russiaWord = "";
    var englishWord = "";


    $('.word').keypress(function(e){
        e = e || event;
        if (e.ctrlKey || e.altKey || e.metaKey) return;
        var chr = String.fromCharCode(e.keyCode);
        if((chr < 'a' || chr > 'z') && (chr < 'A' || chr > 'Z')) {
            return false;
        }
    });

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
                englishWord: englishWord,
                date: parseInt(new Date().getTime() / 1000)
            },
            queryResult
        );
    });
}


function queryResult(data){
    $(".chooseTranslate").css("opacity", "0");
    $(".chooseTranslate").css("display", "none");
    $(".word").val("");
    $(".state").text(data);

    $.ajax({
        url: window.prefix+'/?controller=AddWords&action=showAllWords',
        success: Show
    });
}

function onAjaxSuccess (data) {
    $(".chooseTranslate").css("opacity", "1");
    $(".chooseTranslate").css("display", "block");
    $(".chooseTranslate").children().text(data.text[0]);
}