/**
 * Created by Roma on 24.02.2016.
 */

   /* $('.content').on('click', function(){
        $('.sign-up').css("display", "none");
        $('.sign-in').css("display", "none");
    });

    $('.sign-up-click').on('click', function () {
        checkInput("field-email");
        checkInput("field-password");
        $('.sign-up').css("display", "block");
        $('.sign-in').css("display", "none");
        $('.check-sign-up').on('click', function () {
            formArray = getFormValue("form-sign-up");
            var email = formArray['email'];
            var password = formArray['password'];
            var name = formArray['name'];
            error = validate(email, password);
            if (error) {
                $('.warning-login').css('display', 'block');
                $('.alert-warning strong').text(error);
            }
            else {
                $.get('signUp',
                    {
                        email: email,
                        password: password,
                        name: name
                    }
                ).done(function(data){
                        if(data != "true"){
                            $('.form-control').val("");
                            $('.warning-sign-up').css('display', 'block');
                            $('.warning-sign-up strong').text(data);
                        }
                        else{
                            document.location.href = document.location.href+"glossary";
                        }
                });

            }
        });
    });*/

/*--------------------------------------------------------------*/
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
                console.log(data);
                //location.href = location.href+'home';
            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
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
                    console.log(error);
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
            },
            error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
    });
});
