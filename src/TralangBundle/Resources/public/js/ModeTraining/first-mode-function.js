
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

function playWord(word){
    var url = "https://tts.voicetech.yandex.net/tts?text="+word+"&lang=en_GB&format=wav&quality=lo&platform=web&application=translate";
    $('audio').attr('src', url).get(0).play();
}
