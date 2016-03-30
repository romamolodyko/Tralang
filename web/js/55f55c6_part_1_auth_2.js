/**
 * Created by Roma on 24.02.2016.
 */


$('.sign-in-click').on('click', function () {
    $('.sign-up').css("display", "none");
    $('.sign-in').css("display", "block");
    $('.check-login').on('click', function () {
        var msg   = $('#form-login').serialize();
        console.log(msg);
        $.ajax({
            type: 'POST',
            url: 'login_check',
            data: msg,
            success: function(data) {
                $('.login-error').children().text(data);
                //console.log(data);
                //location.href = location.href+'home';
            }
        });
    });
});
//___________________________________________________________________________-'
$('.sign-up-click').on('click', function () {
    $('.sign-up').css("display", "block");
    $('.check-sign-up').on('click', function () {
        var msg   = $('#form-sign-up').serialize();
        console.log(msg);
        $.ajax({
            type: 'POST',
            url: 'register',
            data: msg,
            success: function(data) {
                if(data === "home"){
                    location.href = location.href+data;
                }
                else {
                    error = JSON.parse(data);
                    //location.href = location.href+data;
                    e_email = error.email;
                    e_username = error.username;
                    e_password = error.plainPassword;
                    e_secondPassword = error.secondPassword;
                    t = 'children[plainPassword]';
                    $('.user-error').children().text(e_username);
                    $('.email-error').children().text(e_email);
                    $('.password-first-error').children().text(e_password);
                    $('.password-second-error').children().text(e_secondPassword);
                }
            }
        });
    });
});
var ErrorGet = new GetErrorAuth({email : 'Roma',
    username : 'Oasd'});
console.log(ErrorGet.errorLogin());
