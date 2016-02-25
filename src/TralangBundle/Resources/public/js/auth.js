/**
 * Created by Roma on 24.02.2016.
 */

    $('.content').on('click', function(){
        $('.sign-up').css("display", "none");
        $('.sign-in').css("display", "none");
    });

    $('.sign-in-click').on('click', function () {
        $('.sign-up').css("display", "none");
        $('.sign-in').css("display", "block");
        $('.check-login').on('click', function () {
            formArray = getFormValue("form-login");
            var email = formArray['email'];
            var password = formArray['password'];
            error = validate(email, password);
            if (error) {
                $('.warning-login').css('display', 'block');
                $('.alert-warning strong').text(error);
            }
            else {
                $.get('login',
                    {
                        email: email,
                        password: password
                    }
                ).done(function(data){
                        if(data == "false"){
                            $('.form-control').val("");
                            $('.warning-login').css('display', 'block');
                            $('.warning-login strong').text("That user doesn't exist!");
                        }
                        else{
                            document.location.href = document.location.href+data;
                        }
                });

            }
        });
        checkInput("field-email");
        checkInput("field-password");
        $('.send').on('click', function(){
            console.log($(this).text());
        })

    });