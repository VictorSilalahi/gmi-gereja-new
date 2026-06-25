import { ajax_get, ajax_post } from "../ajx.js";
import { createPDF } from "../report.js";

let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {

  $(".btn-print").hide();

});

$(document).on("change", "#slcKelompokUmur", function () {

  var kelompok_umur = $(this).val();

  $.LoadingOverlay("show");
  
  loadDataJemaat(kelompok_umur);

  $.LoadingOverlay("hide");
  
});

$(document).on("click", ".btn-print", function(e) {

  var kelompok_umur = $("#slcKelompokUmur option:selected").text();
  var header = "<p><h3>Report Jemaat per Kelompok Umur</h3></p><p><h4>Kelompok : "+kelompok_umur+"</h4></p>";
  createPDF("bodyReport", header, "p", "Report_Kelompok_Umur");



});


function loadDataJemaat(kelompok_umur) {

  var jawab = ajax_post(base_url+"report/jemaat/kelompokumur", {"kelompok_umur": kelompok_umur });

  // console.log(kelompok_umur);
  $("#tblJemaat tbody").html("");
  $(".btn-print").hide();
  
  if (jawab.msg=="ok") {

    let jumlah = 0;
    let data = null;

    if (kelompok_umur=='anak-anak') {
      jumlah = jawab['data']['anak-anak'].length;
      data = jawab['data']['anak-anak'];
    }
    if (kelompok_umur=='remaja') {
      jumlah = jawab['data']['remaja'].length;
      data = jawab['data']['remaja'];
    }
    if (kelompok_umur=='pemuda') {
      jumlah = jawab['data']['pemuda'].length;
      data = jawab['data']['pemuda'];
    }
    if (kelompok_umur=='dewasa') {
      jumlah = jawab['data']['dewasa'].length;
      data = jawab['data']['dewasa'];
    }
    if (kelompok_umur=='lansia') {
      jumlah = jawab['data']['lansia'].length;
      data = jawab['data']['lansia'];
    }

    var isi = '';
    
    var no = 1;
    for (var i=0; i<jumlah; i++) {
        isi = isi + "<tr><td>"+no+"</td><td>"+data[i]['nik']+"</td><td>"+data[i]['nama']+"</td><td>"+data[i]['alamat']+"</td><td>"+data[i]['sektor']+"</td><td>"+data[i]['status_keanggotaan']+"</td></tr>";
        no++;
    }

    $("#tblJemaat tbody").html(isi);
  
    $(".btn-print").show();
  }
}


