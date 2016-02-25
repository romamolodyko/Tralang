/**
 * Created by Roma on 20.02.2016.
 */
$(document).ready(initPage());

function initPage(){
    var russiaWord = "";
    var englishWord = "";


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
            }
        );
    });
}

function onAjaxSuccess (data) {
    $(".chooseTranslate").css("opacity", "1");
    $(".chooseTranslate").css("display", "block");
    $(".chooseTranslate").children().text(data.text[0]);
}

function checkInput(nameField){
    $('#'+nameField).keypress(function(e){
        e = e || event;
        if (e.ctrlKey || e.altKey || e.metaKey) return;
        var chr = String.fromCharCode(e.keyCode);
        if((chr < 'a' || chr > 'z') && (chr < 'A' || chr > 'Z') && (chr < '0' || chr > '9') && (chr != '@') && (chr != '.')) {
            return false;
        }
    });
}

function getFormValue(nameForm){
    var form = $("#"+nameForm).serializeArray();
    a = [];
    for(var i = 0; form.length > i; i++){
        a[form[i].name] = form[i].value;
    }
    return a;
}

function validate(email, password) {
    var error = "";
    if(!email || !password){
        error = "Fill in all the fields!";
        return error;
    }
    else return false;
}
