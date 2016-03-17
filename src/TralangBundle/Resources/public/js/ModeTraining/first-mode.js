$('.start-TW').on('click', function () {
    'use strict';

    var idModeTraine = $(this).attr('data-mode-train');
    var trainer = new Trainer(idModeTraine);
    trainer.start();
});

$('.start-LW').on('click', function () {
    'use strict';

    var idModeTraine = $(this).attr('data-mode-train');
    var trainer = new Trainer(idModeTraine);
    trainer.start();
});
$('.start-WT').on('click', function () {
    'use strict';

    var idModeTraine = $(this).attr('data-mode-train');
    var trainer = new Trainer(idModeTraine);
    trainer.start();
});
/**
 * @constructor
 */
var Trainer = function (mode) {
    'use strict';

    this.answer = {};
    this.counterWords = 0;
    this.modeTraining = EnumModeTraining.create(mode);
    this.rightBlock = $('.list-right-words');
    this.wrongBlock = $('.list-wrong-words');
    this.counter = 0;
    this.next = function (oneWordData) {
        var wordTrain = new this.modeTraining(oneWordData, this.getOneResult);
        wordTrain.start();
        this.counterWords++;
    };

    this.getOneResult = function (result) {
        this.currentWord = this.collection[this.idWords[this.counterWords]];
        this.answer[this.idWords[this.counterWords - 1]] = result;
        if (this.counterWords == this.idWords.length) {
            this.saveData();
        } else {
            this.next(this.currentWord);
        }
    }.bind(this);

    this.saveData = function () {
        console.log(this.answer);
        this.showResult();
        $.get('setState', {
            wordsAnswers : this.answer
        }).done(function (data) {

        });
    };

    this.getData = function (cb) {
        var collection;
        $.get('getWords').done(function (data) {
            collection = JSON.parse(data);
            if (typeof cb === 'function') {
                cb(collection);
            }
        });
    };

    this.start = function () {
        this.getData(function (collection) {
            this.collection = collection.words;
            this.idWords = collection.word_seq;
            this.currentWord = this.collection[this.idWords[0]];
            this.next(this.currentWord);
        }.bind(this));
    };

    this.showResult = function () {
        for (var id in this.answer) {
            var word = (this.answer[id]).split("/");
            if (word[1] === "false"){
                var w = "<li class='list-group-item'>"+word[0] + " - " + word[1]+"</li>";
                this.wrongBlock.append(w);
                this.counter++;
            }
        }
        this.show();
    };

    this.show = function () {
        $('.second_mode').css('display', 'none');
        $('.learn-words-container').css('display', 'none');
        if (this.counter == 0){
            $('.block-success').css('display', 'block');
        } else {
            $('.block-wrong').css('display', 'block');
        }
    }
};

var EnumModeTraining = ABone.create(function () {
    'use strict';

    this.constructor.TRAIN_WT = 1;
    this.constructor.TRAIN_TW = 2;
    this.constructor.TRAIN_LW = 3;
    this.constructor.create = function (val) {
        var classes = {};
        classes[this.TRAIN_WT] = TrainWT;
        classes[this.TRAIN_TW] = TrainTW;
        classes[this.TRAIN_LW] = TrainLW;
        return classes[val];
    };
});
