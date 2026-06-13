import { ajax_get, ajax_post } from "../ajx.js";
import { check_session } from "../sess.js";

$(document).ready(function() {

  check_session();
  console.log("session");
  
  ambil_data_gereja();

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
      var jawab = ajax_post("seting/password/change", {"password_baru": password_baru});

      if (jawab.msg=='ok') {
        alert("Password telah diubah dan disimpan!");
        $("#txtPassword1").val("");
        $("#txtPassword2").val("");
      } else {
        alert("Password gagal disimpan. Error!");
      }

    }
  });


  $(".btn-update-gereja").on("click", function() {
    
    if ($("#txtNamaGereja").val()=='') {
      alert("Masukkan nama gereja!");
      $("#txtNamaGereja").focus();
      return false;
    }

    if ($("#txtAlamatGereja").val()=='') {
      alert("Masukkan alamat gereja!");
      $("#txtAlamatGereja").focus();
      return false;
    }


    if (confirm("Apakah data gereja akan diubah?")==true) {
      
      var nama_gereja_baru = $("#txtNamaGereja").val();
      var alamat_gereja_baru = $("#txtAlamatGereja").val();
      var jawab = ajax_post("seting/gereja/change", {"nama_gereja_baru": nama_gereja_baru, "alamat_gereja_baru": alamat_gereja_baru});

      if (jawab.msg=='ok') {
        alert("Data Gereja telah diubah dan disimpan!");
        window.location.reload();
      
      } else {
      
        alert("Data gereja gagal disimpan. Error!");
      
      }

    }
  });

});

function ambil_data_gereja() {

  var jawab = ajax_get("seting/gereja", {});

  if (jawab.msg=='ok') {
    $("#txtNamaGereja").val(jawab.data[0]['nama']);
    $("#txtAlamatGereja").val(jawab.data[0]['alamat']);

  } else {
    alert("data gereja gagal diambil!");
  }


}