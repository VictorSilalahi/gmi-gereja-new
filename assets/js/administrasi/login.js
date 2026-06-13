import { ajax_get, ajax_post } from "../ajx.js";
import { set_tanggal } from "../format.js"

$(document).ready(function () {
  // loadDataGereja();
  // loadDataKegiatan();
});

$(document).on("click", ".berita", function() {

  let kegiatan_id = $(this).prev().attr("id");

  var berita = ajax_get("administrasi/kegiatan/get", {"kegiatan_id": kegiatan_id});

  console.log(berita);

  let tanggal = set_tanggal(berita['data'][0]['tanggal']);
  let judul = berita['data'][0]['judul'];
  let deskripsi = berita['data'][0]['deskripsi'];

  $("#modalBerita .modal-title").html(tanggal);

  $("#modalBerita #judul").html("<h4>"+judul+"</h4>");
  $("#modalBerita #deskripsi").html("<h6>"+deskripsi+"</h6>");

  $("#modalBerita").modal("show");

});

// function loadDataGereja() {

//   var data = ajax_get("administrasi/seting/gereja", "");

//   // console.log(data);

//   if (data.msg == "ok") {

//     $("#lblNamaGereja").text(data.data[0]['nama']);
//     $("#lblAlamatGereja").text(data.data[0]['alamat']);
//     $(".CopyRight").html("Copyright@"+data.data[0]['copyright']);


//   }


// }

// function loadDataKegiatan() {

//   var data = ajax_get("administrasi/kegiatan/forlogin", "");

//   // console.log(data);

//   if (data.msg == "ok") {
//     var isi = "";
//     for (var i = 0; i < data.data.length; i++) {
//       isi =
//         isi +
//         "<p id='"+data.data[i]['kegiatan_id']+"'><span class='badge bg-secondary'>" +
//         set_tanggal(data.data[i]["tanggal"]) + 
//         "</span><h4 class='berita' data-target='#modalBerita'><a href='#'>" + 
//         data.data[i]["judul"] + "</a></h4></p>";
//     }
//     $("#divKegiatan").html(isi);
//   }


// }

