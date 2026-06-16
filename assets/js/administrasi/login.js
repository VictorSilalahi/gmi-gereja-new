import { pesan_error } from "../pesan.js";
import { ajax_post, ajax_get, fetch_post, fetch_get, fetch_post2 } from "../ajx.js";

$(document).ready(function () {

});

$(document).on("click", ".btn-login", function() {
    
    let email = '';
    let password = '';
    let base_url = '';
    let temp;

    if ($("#txtEmail").val()=='')
    {
        pesan_error("Masukkan email!");
        return false;
    }

    if ($("#txtPassword").val()=='')
    {
        pesan_error("Masukkan password!");
        return false;
    }

    email = $("#txtEmail").val();

    if (isEmail(email)==false) {
        pesan_error("Format email salah!");
        return false;
    }

    password = $("#txtPassword").val();

    base_url = $("#base_url").val();

    $.LoadingOverlay("show");

    temp = ajax_post(base_url+"validasi", {"email": email, "password": password});
    console.log(temp);

});


function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}








