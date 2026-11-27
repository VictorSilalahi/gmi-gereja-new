import { pesan_error, pesan_sukses } from "../pesan.js";
import { ajax_post, ajax_get, fetch_post, fetch_get, fetch_post2 } from "../ajx.js";

$(document).on("click", ".btn_proses", function() {

    if ($("#txtEmailGereja").val()=='') {

        pesan_error("Masukkan email gereja!");
        return false;

    }

    if (isEmail($("#txtEmailGereja").val())==false) {

        pesan_error("Email gereja salah!");
        return false;

    }

    $.LoadingOverlay("show");

    let email = $("#txtEmailGereja").val();

    let base_url = $("#base_url").val();

    let temp = ajax_post(base_url+"daftar/cek_email", {"jenis": "gereja", "email": email});

    $.LoadingOverlay("hide");
    
    // console.log(temp);

    if (temp.status=="ok") {
        
        if (temp.jumlah==1) {

            let kirim_ulang = ajax_post(base_url+"repostpasswrd", {"email": email });

            if (kirim_ulang.msg=='ok') {

                pesan_sukses("Password masuk SIGMI telah kembali dikirim ke email gereja. Mohon melakukan cek ulang di email gereja anda. Terima kasih.")
            }

        } else {

            pesan_error("Login dan password salah!");

        }

    }
    
});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
