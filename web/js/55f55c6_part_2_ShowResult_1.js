var ShowResult = function () {

    this.start = function (answer) {
        this.wrongBlock = $('.list-wrong-words');
        this.counter = 0;
        this.answer = answer;
        this.showResult();
    };

    this.showResult = function () {
        for (var id in this.answer) {
            var word = (this.answer[id]).split("/");
            if (word[1] === "false") {
                var w = "<li class='list-group-item'>" + word[0] + " - " + word[1] + "</li>";
                this.wrongBlock.append(w);
                this.counter++;
            }
        }
        this.show();
    };

    this.show = function () {
        $('.second_mode').css('display', 'none');
        $('.learn-words-container').css('display', 'none');
        if (this.counter == 0) {
            $('.block-success').css('display', 'block');
        } else {
            $('.block-wrong').css('display', 'block');
        }
    }
};


