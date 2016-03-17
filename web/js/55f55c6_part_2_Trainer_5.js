/**
 * Created by Roma on 18.03.2016.
 */
var Trainer = function (mode) {
    'use strict';

    this.answer = {};
    this.counterWords = 0;
    this.modeTraining = EnumModeTraining.create(mode);
    this.wrongBlock = $('.list-wrong-words');
    this.counter = 0;

    /**
     *@param oneWordData
     * This method is getting object and is creating some mode training
     */
    this.next = function (oneWordData) {
        var wordTrain = new this.modeTraining(oneWordData, this.getOneResult);
        wordTrain.start();
        this.counterWords++;
    };

    /**
     * @type {function(this:Trainer)}
     * Getting and save answer result, if this last words then save result, otherwise set next word
     */
    this.getOneResult = function (result) {
        this.currentWord = this.collection[this.idWords[this.counterWords]];
        this.answer[this.idWords[this.counterWords - 1]] = result;
        if (this.counterWords == this.idWords.length) {
            this.saveData();
        } else {
            this.next(this.currentWord);
        }
    }.bind(this);

    /**
     * Save results of training to database
     */
    this.saveData = function () {
        console.log(this.answer);
        this.showResult();
        $.get('setState', {
            wordsAnswers : this.answer
        }).done(function (data) {

        });
    };

    /**
     * Get collection words from database
     */
    this.getData = function (cb) {
        var collection;
        $.get('getWords').done(function (data) {
            collection = JSON.parse(data);
            if (typeof cb === 'function') {
                cb(collection);
            }
        });
    };

    /**
     * Save words on variable and set first words
     */
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