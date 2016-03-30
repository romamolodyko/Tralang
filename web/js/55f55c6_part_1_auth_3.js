/**
 * Created by Roma on 24.02.2016.
 */


$('.sign-in-click').on('click', function () {
    $('.sign-up').css("display", "none");
    $('.sign-in').css("display", "block");
    $('.check-login').on('click', function () {
        var msg   = $('#form-login').serialize();
        $.ajax({
            type: 'POST',
            url: 'login_check',
            data: msg,
            success: function(data) {
                str = data.replace(/(^\s*)|(\s*)$/g, '');
                if (str === 'Bad credentials.') {
                    $('.login-error').children().text(data);
                } else {
                    location.href = location.href+'home';
                }
            }
        });
    });
});
//___________________________________________________________________________-'
$('.sign-up-click').on('click', function () {
    $('.sign-up').css("display", "block");
    $('.check-sign-up').on('click', function () {
        var msg   = $('#form-sign-up').serialize();
        $.ajax({
            type: 'POST',
            url: 'register',
            data: msg,
            success: function(data) {
                if(data === "home") {
                    location.href = location.href + data;
                } else {
                    var error = JSON.parse(data),
                        setError = new SetErrorAuth(error);
                    setError.setErrorLogin();
                }
            }
        });
    });
});
