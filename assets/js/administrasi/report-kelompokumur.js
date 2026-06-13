import { ajax_get, ajax_post } from "../ajx.js";
import { createPDF } from "../report.js";


$(document).ready(function () {

  $(".btn-print").hide();

});

$(document).on("change", "#slcKelompokUmur", function () {

  var kelompok_umur = $(this).val();

  loadDataJemaat(kelompok_umur);

});

$(document).on("click", ".btn-print", function(e) {

  var kelompok_umur = $("#slcKelompokUmur option:selected").text();
  var header = "<p><h3>Report Jemaat per Kelompok Umur</h3></p><p><h4>Kelompok : "+kelompok_umur+"</h4></p>";
  createPDF("bodyReport", header, "p", "Report_Kelompok_Umur");



});


function loadDataJemaat(kelompok_umur) {

  var jawab = ajax_post("/administrasi/jemaat/kelompokumur", {"kelompok_umur": kelompok_umur });

  $("#tblJemaat tbody").html("");
  $(".btn-print").hide();
  
  if (jawab.msg=="ok") {

    var jumlah = jawab['data'].length;

    var isi = '';
    
    var no = 1;
    for (var i=0; i<jumlah; i++) {
        isi = isi + "<tr><td>"+no+"</td><td>"+jawab['data'][i]['nik']+"</td><td>"+jawab['data'][i]['nama']+"</td><td>"+jawab['data'][i]['alamat']+"</td><td>"+jawab['data'][i]['sektor']+"</td><td>"+jawab['data'][i]['status_keanggotaan']+"</td></tr>";
        no++;
    }

    $("#tblJemaat tbody").html(isi);
  
    $(".btn-print").show();
  }
}


