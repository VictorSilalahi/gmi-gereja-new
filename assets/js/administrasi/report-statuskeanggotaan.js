import { ajax_get, ajax_post } from "../ajx.js";
import { createPDF } from "../report.js";


$(document).ready(function () {

  $(".btn-print").hide();

});

$(document).on("change", "#slcStatusKeanggotaan", function () {

  var status = $(this).val();

  loadDataJemaat(status);

});

$(document).on("click", ".btn-print", function(e) {

  var status = $("#slcStatusKeanggotaan option:selected").text();
  var header = "<p><h3>Report Jemaat per Status</h3></p><p><h4>Status : "+status+"</h4></p>";
  createPDF("bodyReport", header, "p", "Report_Kelompok_Umur");


});


function loadDataJemaat(status_keanggotaan) {

  var jawab = ajax_post("/administrasi/jemaat/statuskeanggotaan", {"status_keanggotaan": status_keanggotaan });

  $("#tblJemaat tbody").html("");
  $(".btn-print").hide();
  
  if (jawab.msg=="ok") {

    var jumlah = jawab['data'].length;

    var isi = '';
    
    var no = 1;
    for (var i=0; i<jumlah; i++) {
        isi = isi + "<tr><td>"+no+"</td><td>"+jawab['data'][i]['nik']+"</td><td>"+jawab['data'][i]['nama_anggota_keluarga']+"</td><td>"+jawab['data'][i]['alamat']+"</td><td>"+jawab['data'][i]['jumlah']+"</td><td>"+jawab['data'][i]['status_keanggotaan']+"</td></tr>";
        no++;
    }

    $("#tblJemaat tbody").html(isi);
  
    $(".btn-print").show();
  }
}


