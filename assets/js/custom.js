/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

let _baseUrl = 'https://pklonline.net/api/'
// let _baseUrl = 'http://localhost/pkl-online/api/'

$(document).ready(() => {

    $.ajax({
        type: "GET",
        url: _baseUrl + "institution/all",
        dataType: "json",
        success: function (response) {
            console.log(response.data);
            let result = '<option value="">Pilih asal sekolah/universitas</option>';
            response.data.forEach((element) => {
                result += `<option value="${element.INSTITUTION_ID}">${element.INSTITUTION_NAME}</option>`;
            })
            $("#institution").html(
                result
            )
        }
    });

    $('#form-register').on('submit', function(e) {
        e.preventDefault();
        $('#register-success').hide()
        $('#register-failed').hide()

        $.ajax({
            type: "POST",
            url: _baseUrl + "auth/register",
            data: $('#form-register').serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response.data);
                if (response.status) {
                    $('#register-success').html(response.message)
                    $('#register-success').show()
                    setTimeout(() => {
                        window.history.back
                    }, 2000);
                } else {
                    $('#register-failed').html(response.message)
                    $('#register-failed').show()
                }
            }
        });
    });
    
    $('#form-login').on('submit', function(e) {
        e.preventDefault();
        $('#login-success').hide()
        $('#login-failed').hide()

        $.ajax({
            type: "POST",
            url: _baseUrl + "auth/login",
            data: $('#form-login').serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response.data);
                if (response.status) {
                    $('#login-success').html(response.message)
                    $('#login-success').show()
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);
                    
                } else {
                    $('#login-failed').html(response.message)
                    $('#login-failed').show()
                }
            }
        });
    });
})

function setPicked(e) {
    if (e.hasClass('border border-primary'))
        e.addClass('border border-primary')
    else
        e.removeClass('border border-primary')
 }