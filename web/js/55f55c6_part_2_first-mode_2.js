// Получить набор слов для тренировки

/*$('#query_words').on('click', function(){
    $.ajax({
        url: window.prefix+'/?controller=PracticeWords&action=getWords',
        success : parseQuery
    });
    FirstMode.counter = 0;
    $('#query_words').css("display", "none");
    $('.next_word').css("display", "block");
});

// Вызов следующего слова
$('.next_word').on('click', function(){
    FirstMode.counter++;
    FirstMode.setWord(General.packageWords, FirstMode.counter);
});
*/

/*
FirstMode.setWord = function(word, counter){
    if(counter < 5){
        var word = word[counter].split(" ");
        $('.en_word').text(word[1]);
        $('.ru_word').text(word[0]);
        playWord(word[1]);
    }
    else{
        SecondMode.start();
    }

};

SecondMode.start = function(){
    $('.next_word').attr("class", "second");
    $('.second').css('display', "none");
    $('.first_mode').css('display', "none");
    $('.second_mode').css('display', "block");
    var arrayWords = General.packageWords;
    nextWord(1, 0, arrayWords);
};*/