var TrainLW = function (oneWordData, nextWord) {
    'use strict';

    this.data = oneWordData;
    this.getNextWord = nextWord;
    this.word = $('.word');
    this.translateWord = $('.word-translate');
    this.buttonNext = $('.next-word');

    this.start = function () {
        this.setView();
        this.buttonNext.on('click', this.nextWord);
    };

    this.nextWord = function () {
        if (typeof this.getNextWord === 'function') {
            this.getNextWord();
        }
    };

    this.setView = function () {
        this.sound();
        $('.choose-mode').css('display', 'none');
        $('.learn-words').css('display', 'block');
        this.word.text(this.data.text);
        this.translateWord.text(this.oneWordToShow.textTranslate);
    }.bind(this);

    this.sound = function () {
        var url = "https://tts.voicetech.yandex.net/tts?text=" + this.oneWordToShow + "&lang=en_GB&format=wav&quality=lo&platform=web&application=translate";
        $('audio').attr('src', url).get(0).play();
    };
};