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
