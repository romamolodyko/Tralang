TrainWT = function (oneWordData, nextWord) {
    'use strict';

    TemplateTrains.apply(this, arguments);

    this.setView = function () {
        this.sound();
        $('.list-group-item').attr('class', "list-group-item");
        $('.choose-mode').css('display', 'none');
        $('.second_mode').css('display', 'block');
        var i = 0, word = "";
        this.liText.text(this.oneWordToShow);
        for (i; i < this.data.word_seq.length; i++) {
            word = this.data.mix_words[this.data.word_seq[i]];
            $(this.li[i]).text(word.textTranslate).attr('data-translate', word.text);
        }
    };
};
/*var TrainWT = function (oneWordData, onEndTest) {
    'use strict';

    this.data = oneWordData;
    this.onEndTest = onEndTest;
    this.li = $('.words_list li');
    this.liText = $('.learn-text');
    this.buttonList = $('.list-group-item');
    this.buttonNext = $('.next-group-word');
    this.answer = null;
    this.oneWordToShow = this.data.text;
    var self = this;

    this.start = function () {
        this.setView();
        this.buttonNext.off('click');
        this.buttonList.on('click', this.onAnswer);
        this.buttonNext.on('click', this.onEnd);
    };

    this.onAnswer = function () {
        if (self.oneWordToShow == $(this).attr('data-translate')) {
            self.answer = true;
            $(this).attr('class', "list-group-item list-group-item-success");
        } else {
            self.answer = false;
            $(this).attr('class', "list-group-item list-group-item-danger");
        }
        self.buttonList.off('click');
        // ... if true or wrong answer
    };

    this.onEnd = function () {
        // Get answer result is true or false
        if (typeof this.onEndTest === 'function') {
            this.onEndTest(this.answer);
        } else {
            throw new Error('On end handler is not a function');
        }
    }.bind(this);

    this.setView = function () {
        this.sound();
        $('.list-group-item').attr('class', "list-group-item");
        $('.choose-mode').css('display', 'none');
        $('.second_mode').css('display', 'block');
        var i = 0, word = "";
        this.liText.text(this.oneWordToShow);
        for (i; i < this.data.word_seq.length; i++) {
            word = this.data.mix_words[this.data.word_seq[i]];
            $(this.li[i]).text(word.textTranslate).attr('data-translate', word.text);
        }
    }.bind(this);

    this.sound = function () {
        var url = "https://tts.voicetech.yandex.net/tts?text=" + this.oneWordToShow + "&lang=en_GB&format=wav&quality=lo&platform=web&application=translate";
        $('audio').attr('src', url).get(0).play();
    };
};*/