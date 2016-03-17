/*LearnMode = function () {
    var self = this;
    this.packageWords = [];
    this.counter = 0;
    this.state = 0;
    this.learningWords = [];

    this.learnWords = function (objectWord) {
        try {
            var word = objectWord.words[objectWord.word_seq[this.counter]];
            $('.text').text(word.text);
            $('.textTranslate').text(word.textTranslate);
            this.playWord(word.text);
        } catch (err) {
            $('.error-message').text('Before learn words you need add it!');
            $('.error-block').css('display', 'block');
            $('.next-word').css('display', 'none');
        }
        //var word = objectWord.words[objectWord.word_seq[this.counter]];
        //$('.text').text(word.text);
        //$('.textTranslate').text(word.textTranslate);
        //this.playWord(word.text);
    }

    this.chooseRightWord = function (objectWord, idW) {
        var li = $('.words_list li'), mixWords = [], wordSeq = [], word = [];
        var t = objectWord.words[objectWord.word_seq[this.counter]];
        mixWords = t.mix_words;
        for (id in mixWords){
            wordSeq.push(id);
        }
        for(var i = 0; i<wordSeq.length; i++){
            word.push(mixWords[wordSeq[i]].text+"-"+mixWords[wordSeq[i]].textTranslate);
        }
        word.push(t.text+"-"+ t.textTranslate);
        shuffle(word);
        if(idW == 0){
            $('.learn-text').text(t.textTranslate).attr('data-translate', t.text);
        }
        else{
            $('.learn-text').text(t.text).attr('data-translate', t.textTranslate);
        }
        for(var j = 0; word.length > j; j++){
            var words = word[j].split('-');
            $(li[j]).text(words[idW]);
        }
    };

    this.playWord = function(word){
        var url = "https://tts.voicetech.yandex.net/tts?text="+word+"&lang=en_GB&format=wav&quality=lo&platform=web&application=translate";
        $('audio').attr('src', url).get(0).play();
    };

    this.result = function(){
        for(var i = 0; i < this.learningWords.length; i++){
            t = this.learningWords[i].split('-');
            if (t[1] == 0){
                console.log(t[0]+" - wrong");
            }
            else{
                console.log(t[0]+" - true");
            }
        }
    }
};*/