"use strict";
$(document).ready(function() {

    $("#username").focus().select();

    $(".submit-register").on('click', 'input', function(e) {
        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var repeatpassword = $("#repeatpassword").val();
        var apikey = $("#apikey").val();
        var vcode = $("#vcode").val();
        var reports = $("#reports").attr('id');
        
        $("#username").parent('div').removeClass('has-error');
        $("#email").parent('div').removeClass('has-error');
        $("#password").parent('div').removeClass('has-error');
        $("#repeatpassword").parent('div').removeClass('has-error');
        $("#apikey").parent('div').removeClass('has-error');
        $("#vcode").parent('div').removeClass('has-error');
        $("#reports").parent('div').removeClass('has-error');
        if (username.length < 6) {
            $("#username").parent('div').addClass('has-error');
            e.preventDefault();
        }
        if (!isEmail(email)) {
            $("#email").parent('div').addClass('has-error');
            e.preventDefault();
        }
        if (password.length < 6) {
            $("#password").parent('div').addClass('has-error');
            e.preventDefault();
        }
        if (password != repeatpassword || repeatpassword.length == 0) {
            $("#repeatpassword").parent('div').addClass('has-error');
            e.preventDefault();
        }
        if (apikey.length < 6) {
            $("#apikey").parent('div').addClass('has-error');
            e.preventDefault();
        }
        if (vcode.length < 6) {
            $("#vcode").parent('div').addClass('has-error');
            e.preventDefault();
        }
        if (reports.length < 6) {
            $("#reports").parent('div').addClass('has-error');
            e.preventDefault();
        }
    })
});