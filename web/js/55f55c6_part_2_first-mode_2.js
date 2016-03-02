// Получить набор слов для тренировки
LearnMode = function(){
    var self = this;
    this.packageWords;

    this.counter = 0;

    this.state = 0;

    this.learnWords = function(objectWord){
        var word = objectWord.words[objectWord.word_seq[this.counter]];
        $('.text').text(word.text);
        $('.textTranslate').text(word.textTranslate);
        this.playWord(word.text);
    };

    this.chooseRightWord = function(objectWord, idW){
        var li = $('.words_list li');
        t = objectWord.words[objectWord.word_seq[this.counter]];
        mixWords = t.mix_words;
        var wordSeq = [], word = [];
        for(id in mixWords){
            wordSeq.push(id);
        }
        for(var i = 0; i<wordSeq.length; i++){
            word.push(mixWords[wordSeq[i]].text+"-"+mixWords[wordSeq[i]].textTranslate);
        }
        word.push(t.text+"-"+ t.textTranslate);
        shuffle(word);
        if(idW == 0){
            $('.learn-text').text(t.textTranslate);
        }
        else{
            $('.learn-text').text(t.text);
        }
        for(var j = 0; word.length > j; j++){
            var words = word[j].split('-');
            $(li[j]).text(words[idW]);
        }
    };

    this.playWord = function(word){
        var url = "https://tts.voicetech.yandex.net/tts?text="+word+"&lang=en_GB&format=wav&quality=lo&platform=web&application=translate";
        $('audio').attr('src', url).get(0).play();
    }
};
var counter = 0;
var Generate = new LearnMode();

$('.start-training').on('click', function(){
    $.get('getWords').done(function(data){
        Generate.packageWords = JSON.parse(data);
        Generate.learnWords(Generate.packageWords);
        $('.choose-mode').css('display', 'none');
        $('.learn-words').css('display', 'block');
    });
});

$('.next-word').on('click', function(){
    if(Generate.counter < 4){
        Generate.counter += 1;
        Generate.learnWords(Generate.packageWords);
    }
    else{
        $('.second_mode').css('display', 'block');
        $('.learn-words').css('display', 'none');
        Generate.counter = 0;
        Generate.chooseRightWord(Generate.packageWords, id=0);
    }
});
$('.next-group-word').on('click', function(){
    if(Generate.state == 0){
        if(Generate.counter < 4){
            Generate.counter += 1;
            Generate.chooseRightWord(Generate.packageWords, id=0);
        }
        else{
            Generate.counter = 0;
            Generate.state = 1;
            Generate.chooseRightWord(Generate.packageWords, id=1);
        }

    }else{
        Generate.counter += 1;
        Generate.chooseRightWord(Generate.packageWords, id=1);
    }
});
