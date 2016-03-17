TrainTW = function (oneWordData, nextWord) {
    'use strict';

    TemplateTrains.apply(this, arguments);

    this.oneWordToShow = this.data.textTranslate;
    this.setView = function () {
        $('.list-group-item').attr('class', "list-group-item");
        $('.choose-mode').css('display', 'none');
        $('.second_mode').css('display', 'block');
        var i = 0, word = "";
        this.liText.text(this.oneWordToShow);
        for (i; i < this.data.word_seq.length; i++) {
            word = this.data.mix_words[this.data.word_seq[i]];
            $(this.li[i]).text(word.text).attr('data-translate', word.textTranslate);
        }
    };
};

