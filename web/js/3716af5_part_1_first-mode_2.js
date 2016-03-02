// Получить набор слов для тренировки

var counter = 0;
var Generate = new LearnMode();

$('.start-training').on('click', function(){
    $.get('getWords').done(function(data){
        Generate.packageWords = JSON.parse(data);
        Generate.learnWords(Generate.packageWords);
        $('.choose-mode').css('display', 'none');
        $('.learn-words').css('display', 'block');
    });
});

$('.next-word').on('click', function(){
    if(Generate.counter < 4){
        Generate.counter += 1;
        Generate.learnWords(Generate.packageWords);
    }
    else{
        $('.second_mode').css('display', 'block');
        $('.learn-words').css('display', 'none');
        Generate.counter = 0;
        Generate.chooseRightWord(Generate.packageWords, id=0);
    }
});
$('.next-group-word').on('click', function(){
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
            document.location.reload();
        }

    }
});
