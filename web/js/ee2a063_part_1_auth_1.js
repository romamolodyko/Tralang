/**
 * Created by Roma on 24.02.2016.
 */
$(document).ready(initPage());

function initPage() {

    $('.sign-in-click').on('click', function () {
        $('.sign-up').css("display", "none");
        $('.sign-in').css("display", "block");
        $('.check-login').on('click', function () {
            formArray = getFormValue("form-login");
            var email = formArray['email'];
            var password = formArray['password'];
            error = validate(email, password);
            if (error) {
                $('.alert-warning strong').text(error);
            }
            else {
                $.get('login',
                    {
                        email: email,
                        password: password
                    },
                    (function(){
                        $('.alert-warning strong').text(data);
                    })()
                );
            }
            return false;
        });
        checkInput("field-email");
        checkInput("field-password");

    });

    $('.sign-up-click').on('click', function(){
        $('.sign-in').css("display", "none");
        $('.sign-up').css("display", "block");
        $('.check-sign-up').on('click', function () {
            formArray = getFormValue("form-sign-up");
            console.log(formArray);
            /*var email = formArray['email'];
            var password = formArray['password'];
            error = validate(email, password);
            if (error) {
                $('.alert-warning strong').text(error);
            }
            else {
                $.get('login',
                    {
                        email: email,
                        password: password
                    },
                    (function(){
                        $('.alert-warning strong').text(data);
                    })()
                );
            }*/
            return false;
        });
    });
}