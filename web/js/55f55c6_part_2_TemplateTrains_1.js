/**
 * Created by Roma on 15.03.2016.
 */
var TemplateTrains = function (oneWordData, onEndTest) {
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

    /**
     *
     */
    this.start = function () {
        this.setView();
        this.buttonNext.off('click');
        this.buttonList.on('click', this.onAnswer);
        this.buttonNext.on('click', this.onEnd);
    };

    this.onAnswer = function () {
        var wt = self.data.text + " - " + self.data.textTranslate + "/";
        if (self.oneWordToShow == $(this).attr('data-translate')) {
            self.answer = wt + true;
            $(this).attr('class', "list-group-item list-group-item-success");
        } else {
            self.answer = wt + false;
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

    this.sound = function () {
        var url = "https://tts.voicetech.yandex.net/tts?text=" + this.oneWordToShow + "&lang=en_GB&format=wav&quality=lo&platform=web&application=translate";
        $('audio').attr('src', url).get(0).play();
    };
};

