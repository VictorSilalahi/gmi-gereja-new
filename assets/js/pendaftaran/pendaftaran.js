import { pesan_error } from "../pesan.js";
import { ajax_post, ajax_get, fetch_post, fetch_get, fetch_post2 } from "../ajx.js";

let fileSize = 0;

$(document).ready(function() {

});

$(document).on("change", "#fileSK", function() {

    if (this.files && this.files[0]) {
        let fileSizeInBytes = this.files[0].size;
        let fileSizeInMB = (fileSizeInBytes / (1024 * 1024)).toFixed(2);
        fileSize = fileSizeInMB;
    }    

});


$(document).on("click", ".btn-daftar", function() {

    let nama_gereja = '';
    let alamat_gereja = '';
    let email_gereja = '';
    let distrik = '';
    let kondisi_bangunan_gereja = '';
    let kepemilikan_gereja = '';
    let nama_pendeta = '';
    let email_pendeta = '';
    let nama_file = '';


    if ($("#txtNamaGereja").val()=='') {
        pesan_error("Masukkan nama gereja");
        return false;
    }

    if ($("#txtAlamatGereja").val()=='') {
        pesan_error("Masukkan alamat gereja");
        return false;
    }

    if ($("#txtEmailGereja").val()=='') {
        pesan_error("Masukkan email gereja");
        return false;
    }

    // cek format email gereja
    email_gereja = $("#txtEmailGereja").val();

    if (isEmail(email_gereja)==false) {
        pesan_error("Format email gereja salah!");
        return false;
    }


    if ($("#txtNamaPendeta").val()=='') {
        pesan_error("Masukkan nama pendeta");
        return false;
    }

    
    if ($("#txtEmailPendeta").val()=='') {
        pesan_error("Masukkan email pendeta");
        return false;
    }

    // cek format email pendeta
    email_pendeta = $("#txtEmailPendeta").val();

    if (isEmail(email_pendeta)==false) {
        pesan_error("Format email pendeta salah!");
        return false;
    }


    if ($("#fileSK").val()=='') {

        pesan_error("Masukkan file SK!");
        return false;

    }

    // cek file SK
    nama_file = $("#fileSK").val();
    let cek_is_jpg = nama_extension(nama_file);

    if (cek_is_jpg!="jpg") {
        pesan_error("Format file SK salah. Harus menggunakan format JPG!");
        return false;
    }

    // cek ukuran file
    if (fileSize>0.25) {
        pesan_error("Ukuran file terlalu besar!");
        return false;
    }
    

    // cek keberadaan email gereja
    let cek_ada_email = cek_keberadaan_email("gereja", email_gereja);
    
    if (cek_ada_email==true) {
        alert("Email Gereja sudah terdaftar!");
        return false;
    }

    // cek keberadaan email pendeta
    cek_ada_email = cek_keberadaan_email("pendeta", email_pendeta);
    
    if (cek_ada_email==true) {
        alert("Email Pendeta sudah terdaftar!");
        return false;
    }

    // cek keberadaan nama gereja di dalam distrik
    let sudah_ada_nama_gereja = cek_keberadaan_gereja(nama_gereja, distrik);

    if (sudah_ada_nama_gereja==true) {
        pesan_error("Nama Gereja sudah terdaftar pada distrik "+distrik+"!");
        return false;
    }

    
    $("#formDaftar").submit();


});


$(document).on("change", "#fileSK", function() {

    if (this.files && this.files[0]) {
        let fileSizeInBytes = this.files[0].size;
        let fileSizeInMB = (fileSizeInBytes / (1024 * 1024)).toFixed(2);
        fileSize = fileSizeInMB;
    }    

});


function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function nama_extension(nama_file) {

    const file = nama_file;
    if (file) {
        const extension = file.split('.').pop().toLowerCase();
        return extension;
    }    

}

function cek_keberadaan_email(jenis, email) {

    let email_temp = email;
    let base_url = $("#base_url").val()

    let temp = ajax_post(base_url+"daftar/cek_email", {"jenis": jenis, "email": email_temp});

    if (temp.status=='ok') {

        if (temp.jumlah==0) {

            return false;

        } else {

            return true;
        }
    }

}

function cek_keberadaan_gereja(nama_gereja, distrik) {
    
    let temp_nama_gereja = nama_gereja;
    let dist = distrik;
    let base_url = $("#base_url").val()

    let temp = ajax_post(base_url+"daftar/cek_gereja", {"nama_gereja": temp_nama_gereja, "distrik": dist});

    if (temp.status=='ok') {

        if (temp.jumlah==0) {

            return false;

        } else {

            return true;
        }
    }


}

