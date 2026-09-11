import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { check_session } from "../sess.js";

let base_url = $("#base_url").val()+"api/intern/";

let kab_kota_per_provinsi = [];

let lat = 0;
let long = 0;

let centerMarker = null;
let latLang = null;

let distrik = null;
let gereja_id = null;
let nama_gereja = null;
let alamat = null;
let kabupaten_id = null;
let provinsi_id = null;


$(document).ready(function() {


  check_token();

  $.LoadingOverlay("show");

  setProvinsi();

  getInfoGereja();

  setMap();

  $.LoadingOverlay("hide");


  $(".btn-update-password").on("click", function() {
    
    if ($("#txtPassword1").val()=='') {
      alert("Masukkan password baru!");
      $("#txtPassword1").focus();
      return false;
    }

    if ($("#txtPassword2").val()=='') {
      alert("Masukkan kembali password baru!");
      $("#txtPassword2").focus();
      return false;
    }

    if ($("#txtPassword1").val()!=$("#txtPassword2").val()) {
      alert("Password baru masih salah!");
      $("#txtPassword1").focus();
      return false;
    }

    if (confirm("Apakah password akan diubah?")==true) {
      
      var password_baru = $("#txtPassword1").val();
      let token = localStorage.getItem('4pp_t0k3n');
      var jawab = ajax_post(base_url+"seting/password/change", {"password_baru": password_baru, "token": token });

      if (jawab.msg=='ok') {
        alert("Password telah diubah dan disimpan!");
        $("#txtPassword1").val("");
        $("#txtPassword2").val("");
      } else {
        alert("Password gagal disimpan. Error!");
      }

    }
  });

});

$(document).on("click", ".btn-update-nama-gereja", function() {

    let nama_gereja = '';

    if ($("#txtNamaGereja").val()=='') {

      alert("Masukkan nama gereja!");
      $("#txtNamaGereja").focus();
      return false;
      
    }

    if (confirm("Apakah akan mengubah nama gereja?")==true) {

      nama_gereja = $("#txtNamaGereja").val();
      let temp = ajax_post(base_url+"seting/simpannamagereja", {"gereja_id": gereja_id, "nama_gereja": nama_gereja});

    }



});



$(document).on("click", ".btn-update-alamat-gereja", function() {

    let alamat_gereja = '';

    if ($("#txtAlamatGereja").val()=='') {

      alert("Masukkan alamat gereja!");
      $("#txtAlamatGereja").focus();
      return false;
      
    }

    if (confirm("Apakah akan mengubah alamat gereja?")==true) {

      alamat_gereja = $("#txtAlamatGereja").val();
      let temp = ajax_post(base_url+"seting/simpanalamatgereja", {"gereja_id": gereja_id, "alamat_gereja": alamat_gereja});

    }



});


$(document).on("click", ".btn-update-kabkota-gereja", function() {

    let kabkota_gereja = $("#slcKabKota").val();

    if (confirm("Apakah akan mengubah kabupaten/kota gereja?")==true) {

      let temp = ajax_post(base_url+"seting/simpankabkotagereja", {"gereja_id": gereja_id, "kabkota_id": kabkota_gereja});

    }



});


$(document).on("click", ".btn-update-koordinat-gereja", function() {

    if (centerMarker) {
        latLang = centerMarker.getLatLng();
        // Do something with latLng
    } else {
        pesan_error("Koordinat gereja pada peta tidak ada!");
        return false;
    }
    

    if (confirm("Apakah akan mengubah koordinat gereja?")==true) {

      let lat = latLang.lat;
      let lng = latLang.lng;

      let temp = ajax_post(base_url+"seting/simpankoordinatgereja", {"gereja_id": gereja_id, "lat": lat, "lng": lng});

    }



});


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


function setMap() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, error_map);
  } else {
    alert("browser ini tidak support geolocation.");
  }
}



function success(position) {

    // lat = position.coords.latitude;
    // long = position.coords.longitude;

    lat = lat;
    long = long;
    // console.log(lat, long);

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


function getInfoGereja()
{

    let base_url = $("#base_url").val()+"api/intern";

    let token = localStorage.getItem('4pp_t0k3n');
    
    var jawab = ajax_post(base_url+"/seting/getinfogereja", {"token": token});

    console.log(jawab);

    lat = jawab.pesan.lat;
    long = jawab.pesan.lng;

    distrik = jawab.pesan.distrik;
    gereja_id = jawab.pesan.gereja_id;
    nama_gereja = jawab.pesan.nama_gereja;
    alamat = jawab.pesan.alamat;
    kabupaten_id = jawab.pesan.kabupaten_id;
    provinsi_id = jawab.pesan.provinsi_id;

    $("#txtDistrik").text(distrik);
    $("#txtNamaGereja").val(nama_gereja);
    $("#txtAlamatGereja").val(alamat);
    $("#slcProvinsi").val(provinsi_id).change();
    $("#slcKabKota").val(kabupaten_id).change();

}