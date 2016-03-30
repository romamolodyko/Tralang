var GetErrorAuth = function (error) {
    'use strict';

    this.errorEmail = error.email;
    this.erroeUsername = error.username;
    this.errorPassword = error.plainPassword;
    this.errorSecondPassword = error.secondPassword;

    this.errorLogin = function () {
        return this.errorEmail;
    };
};
