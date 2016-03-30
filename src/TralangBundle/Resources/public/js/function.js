/**
 * Created by Roma on 02.03.2016.
 */

function onAjaxSuccess (data) {
    $(".chooseTranslate").css("opacity", "1");
    $(".send").css("display", "block");
    $(".alert").css("display", "none");
    $(".send").text(data.text[0]);
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



function validate(email, password) {
    var error = "";
    if(!email || !password){
        error = "Fill in all the fields!";
        return error;
    }
    else return false;
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

function playWord(word){
    var url = "https://tts.voicetech.yandex.net/tts?text="+word+"&lang=en_GB&format=wav&quality=lo&platform=web&application=translate";
    $('audio').attr('src', url).get(0).play();
}


