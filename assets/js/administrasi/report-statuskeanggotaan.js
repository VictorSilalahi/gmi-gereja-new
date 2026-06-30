import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { createPDF } from "../report.js";

let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {

  check_token();

  $(".btn-print").hide();

});

$(document).on("change", "#slcStatusKeanggotaan", function () {

  var status = $(this).val();

  $.LoadingOverlay("show");

  loadDataJemaat(status);

  $.LoadingOverlay("hide");
});

$(document).on("click", ".btn-print", function(e) {

  var status = $("#slcStatusKeanggotaan option:selected").text();
  var header = "<p><h3>Report Jemaat per Status</h3></p><p><h4>Status : "+status+"</h4></p>";
  createPDF("bodyReport", header, "p", "Report_Kelompok_Umur");


});


function loadDataJemaat(status_keanggotaan) {

  var jawab = ajax_post(base_url+"report/jemaat/statuskeanggotaan", {"status_keanggotaan": status_keanggotaan });

  console.log(jawab);

  $("#tblJemaat tbody").html("");
  $(".btn-print").hide();
  
  if (jawab.msg=="ok") {

    var jumlah = jawab['data'].length;

    var isi = '';
    
    var no = 1;
    for (var i=0; i<jumlah; i++) {
        isi = isi + "<tr><td>"+no+"</td><td>"+jawab['data'][i]['no_sektor']+"</td><td>"+jawab['data'][i]['nik']+"</td><td>"+jawab['data'][i]['nama_keluarga']+"</td><td>"+jawab['data'][i]['alamat']+"</td><td>"+jawab['data'][i]['jumlah']+"</td><td>"+jawab['data'][i]['mobile_phone']+"</td></tr>";
        no++;
    }

    $("#tblJemaat tbody").html(isi);
  
    $(".btn-print").show();
  }
}


