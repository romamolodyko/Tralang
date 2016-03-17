TrainLW = function (oneWordData, nextWord) {
    'use strict';

    TemplateTrains.apply(this, arguments);

    this.word = $('.word');
    this.translateWord = $('.word-translate');
    this.buttonNext = $('.next-word');
    this.oneWordToShow = this.data.text;
    this.answer = null;

    this.setView = function () {
        this.sound();
        this.answer = this.data.text + "/" + true;
        $('.choose-mode').css('display', 'none');
        $('.learn-words').css('display', 'block');
        this.word.text(this.data.text);
        this.translateWord.text(this.data.textTranslate);
    };
};
