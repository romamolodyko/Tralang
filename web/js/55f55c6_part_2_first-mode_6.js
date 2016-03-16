// Получить набор слов для тренировки
/*
var counter = 0;
var Generate = new LearnMode();

$('.start-training').on('click', function () {
    $.get('getWords').done(function (data) {
        Generate.packageWords = JSON.parse(data);
        console.log(Generate.packageWords);
        Generate.learnWords(Generate.packageWords);
        $('.choose-mode').css('display', 'none');
        $('.learn-words').css('display', 'block');
    });
});

$('.next-word').on('click', function () {
    if (Generate.counter < 4) {
        Generate.counter += 1;
        Generate.learnWords(Generate.packageWords);
    }
    else {
        $('.second_mode').css('display', 'block');
        $('.learn-words').css('display', 'none');
        Generate.counter = 0;
        Generate.chooseRightWord(Generate.packageWords, id=0);
        liClick();
    }
});
$('.next-group-word').on('click', function(){
    $('.words_list li').attr("class", "list-group-item");
    liClick();
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
        if(Generate.counter < 4){
            Generate.counter += 1;
            Generate.chooseRightWord(Generate.packageWords, id=1);
        }
        else{
            Generate.result();
            //document.location.reload();
        }

    }
});

function liClick(){
    $('.words_list li').on('click', function(){
        console.log($(this).text());
        var self = this;
        if($(self).text() == $('.learn-text').attr('data-translate')){
            Generate.learningWords.push($(this).text()+'-1');
            $(self).attr("class", "list-group-item list-group-item-success");
        }
        else{
            Generate.learningWords.push($(this).text()+'-0');
            $(self).attr("class", "list-group-item list-group-item-danger");
        }
        $('.words_list li').off('click');
    });
}
*/
// ----------------------------------------------

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

    this.answer = [];
    this.counterWords = 0;
    this.modeTraining = EnumModeTraining.create(mode);
    this.next = function (oneWordData) {
        // Test
        var wordTrain = new this.modeTraining(oneWordData, this.getOneResult);
        wordTrain.start();
        this.counterWords++;
    };

    this.getOneResult = function (result) {
        this.currentWord = this.collection[this.idWords[this.counterWords]];
        this.answer[this.idWords[this.counterWords - 1]] = result;
        // Change currentWord ...
        // If its the last word do something else
        if (this.counterWords == this.idWords.length) {
            this.saveData();
        } else {
            this.next(this.currentWord);
        }
    }.bind(this);

    this.saveData = function () {
        console.log("saveData");
        // ajax
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
