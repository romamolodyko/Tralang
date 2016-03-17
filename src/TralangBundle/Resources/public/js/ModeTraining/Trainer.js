/**
 * Created by Roma on 18.03.2016.
 */
var Trainer = function (mode) {
    'use strict';

    this.answer = {};
    this.counterWords = 0;
    this.modeTraining = EnumModeTraining.create(mode);
    this.showResult = false;

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
        var s = new ShowResult();
        s.start(this.answer);
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
     * Save words in variable this.collection and set first word
     */
    this.start = function () {
        this.getData(function (collection) {
            this.collection = collection.words;
            this.idWords = collection.word_seq;
            this.currentWord = this.collection[this.idWords[0]];
            this.next(this.currentWord);
        }.bind(this));
    };
};