var SetErrorAuth = function (error) {
    'use strict';

    this.errorEmail = error.email;
    this.erroeUsername = error.username;
    this.errorPassword = error.plainPassword;
    this.errorSecondPassword = error.secondPassword;

    this.setErrorLogin = function () {
        $('.user-error').children().text(this.erroeUsername);
        $('.email-error').children().text(this.errorEmail);
        $('.password-first-error').children().text(this.errorPassword);
        $('.password-second-error').children().text(this.errorSecondPassword);
    };
};
