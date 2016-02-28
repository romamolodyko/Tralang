
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




function randomInteger(max) {
    var rand = 0 - 0.5 + Math.random() * (max - 0 + 1);
    rand = Math.round(rand);
    return rand;
}

function divide(string, number){
    var t = string.split(' ');
    return t[number];
}

function getWord(array, n){
    var word = [];
    for (var i = 0; array.length > i; i++) {
        word.push(divide(array[i], n));
    }
    return word;
}

function parseQuery (e){
    var t = JSON.parse(e);
    for (var i = 0; i < t.length; i++){
        //a[t[i]['en_words']] = t[i]['ru_words'];
        General.packageWords.push(t[i]['ru_words']+' '+t[i]['en_words']);
    }
    SecondMode.package = ocopy(General.packageWords);
    FirstMode.setWord(General.packageWords, FirstMode.counter);
}

function shuffle(o){
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
}

function ocopy(o) {
    var no = [];
    for (var k in o) {
        no[k] = o[k];
    }
    return no
}

function nextWord(idShowWord, idShowWord2, array){
    var random = randomInteger(array.length-1);
    var en = array[random].split(' ');
    $('.one_en_word').text(en[idShowWord]).attr("data-translate",en[idShowWord2]);
    playWord(en[idShowWord]);
    nextGroupWord(array[random], idShowWord2);
    array.splice(random, 1);
}

function nextGroupWord(rightWord, idShowWord2) {
    var word = rightWord.split(' ');
    Counter--;
    $.get(window.prefix + '/?controller=PracticeWords&action=getWrongWords',
        {
            rightWord : word[0]
        },
        function (data) {
            var t = JSON.parse(data);
            var li = $('.words_list li');
            var a = [];
            for (var i = 0; i < t.length; i++) {
                a.push(t[i]['ru_words'] + ' ' + t[i]['en_words']);
            }
            a.push(rightWord);
            var w = shuffle(a);
            for(var j = 0; w.length > j; j++){
                var word = w[j].split(' ');
                $(li[j]).text(word[idShowWord2]);
            }

        });
}

function setState(text, state){
    $.get(window.prefix + '/?controller=PracticeWords&action=setStateWord',
        {
            word : text,
            state : state
        });
}

function playWord(word){
    var url = "https://tts.voicetech.yandex.net/tts?text="+word+"&lang=en_GB&format=wav&quality=lo&platform=web&application=translate";
    $('audio').attr('src', url).get(0).play();
}

