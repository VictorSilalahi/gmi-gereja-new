import { pesan_error } from "../pesan.js";
import { ajax_post, ajax_get, fetch_post, fetch_get, fetch_post2 } from "../ajx.js";

let fileSize = 0;

let lat = 0;
let long = 0;

let centerMarker = null;

let kab_kota_per_provinsi = [];

$(document).ready(function() {

    $.LoadingOverlay("show");

    setMap();
    setProvinsi();

    $.LoadingOverlay("hide");

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

    if ($("#slcKabKota").val()=='') {
        pesan_error("Pilih Kabupaten Kota");
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

    if (cek_is_jpg!="jpg" && cek_is_jpg!="jpeg") {
        pesan_error("Format file SK salah. Harus menggunakan format JPG!");
        return false;
    }

    // cek ukuran file
    if (fileSize>1.1) {
        pesan_error("Ukuran file terlalu besar!");
        return false;
    }
    

    // cek keberadaan email gereja
    let cek_ada_email = cek_keberadaan_email("gereja", email_gereja);
    
    if (cek_ada_email==true) {
        pesan_error("Email Gereja sudah terdaftar!");
        return false;
    }

    // cek keberadaan email pendeta
    cek_ada_email = cek_keberadaan_email("pendeta", email_pendeta);
    
    if (cek_ada_email==true) {
        pesan_error("Email Pendeta sudah terdaftar!");
        return false;
    }

    // cek keberadaan nama gereja di dalam distrik
    let sudah_ada_nama_gereja = cek_keberadaan_gereja(nama_gereja, distrik);

    if (sudah_ada_nama_gereja==true) {
        pesan_error("Nama Gereja sudah terdaftar pada distrik "+distrik+"!");
        return false;
    }

    let latLang = centerMarker.getLatLng();
    
    if (latLang == null) {
        pesan_error("Koordinat gereja harus ada!");
        return false;
    }

    $("#txtLat").val(latLang.lat);
    $("#txtLong").val(latLang.lng);
    
    $.LoadingOverlay("show");

    $("#formDaftar").submit();


});


$(document).on("change", "#fileSK", function() {

    if (this.files && this.files[0]) {
        let fileSizeInBytes = this.files[0].size;
        let fileSizeInMB = (fileSizeInBytes / (1024 * 1024)).toFixed(2);
        fileSize = fileSizeInMB;
        console.log(fileSize);
    }    

});

$(document).on("change", "#slcProvinsi", function() {

    let provinsi_id = $("#slcProvinsi").val();

    for (let i=0; i<kab_kota_per_provinsi.length; i++) {

        if (kab_kota_per_provinsi[i]['provinsi id']==provinsi_id) {
            console.log(kab_kota_per_provinsi[i]['data']);

            let data = kab_kota_per_provinsi[i]['data'];

            let opts = '';

            for (let j=0; j<data.length; j++) {

                opts = opts + "<option value='"+data[j]['kabupaten_id']+"'>"+data[j]['kabupaten']+"</option>";

            }

            $("#slcKabKota").html(opts);

        }
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


function setProvinsi() {

    let base_url = $("#base_url").val()
    let temp = ajax_get(base_url+"daftar/provinsi", {});

    if (temp.status=='ok') {

        if (temp.data.length!=0) {
            

            let opts = '';
            for (let i=0; i<temp.data.length; i++) {

                let provinsi_id = temp.data[i]['provinsi_id'];

                let temp_kab_kota = ajax_post(base_url+"daftar/kabkota", {"provinsi_id": provinsi_id});

                let kab_kota = [];
                
                if (temp_kab_kota.status=='ok') {

                    for (let i=0; i<temp_kab_kota.data.length; i++) {

                        kab_kota.push({"kabupaten_id": temp_kab_kota.data[i]['kabupaten_id'], "kabupaten": temp_kab_kota.data[i]['kabupaten']});

                    }
                    
                }

                kab_kota_per_provinsi.push({"provinsi id":temp.data[i]['provinsi_id'], "nama": temp.data[i]['provinsi'], "data": kab_kota });
                opts = opts + "<option value='"+temp.data[i]['provinsi_id']+"'>"+temp.data[i]['provinsi']+"</option>";

            }

            $("#slcProvinsi").html(opts);

            let sbox = document.getElementById("slcProvinsi");
            sbox.selectedIndex = 0;
            const event = new Event('change', { bubbles: true });
            sbox.dispatchEvent(event);


        } else {

            return true;
        }
    }

}



function setMap() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, error_map);
  } else {
    alert("Sorry, browser ini tidak support geolocation.");
  }
}



function success(position) {

    lat = position.coords.latitude;
    long = position.coords.longitude;

    let map = L.map('map').setView([lat, long], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    centerMarker = L.marker([lat, long]).addTo(map);

    // 2. Update marker position every time the map moves
    map.on('move', function() {
        centerMarker.setLatLng(map.getCenter());
    });

}

function error_map() {
  alert("Sorry, posisi tidak bisa didapatkan.");
}

