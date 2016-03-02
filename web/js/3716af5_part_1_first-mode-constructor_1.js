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