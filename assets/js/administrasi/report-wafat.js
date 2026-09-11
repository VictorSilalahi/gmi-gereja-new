import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal_indo, set_tanggal, set_tanggal_database } from "../format.js";
import { createPDF } from "../report.js";

let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {

  check_token();
  
  $(".btn-print").hide();

  $.LoadingOverlay("show");

  loadDataWafat();

  $.LoadingOverlay("hide");

});

$(document).on("click", ".btn-print", function(e) {

  var header = "<p><h3>Report Data Wafat</h3></p>";
  createPDF("bodyReport", header, "p", "Report_Data_Wafat");

});

function loadDataWafat() {

  var jawab = ajax_get(base_url+"report/jemaat/wafat", {});

  $("#tblWafat tbody").html("");
  $(".btn-print").hide();
  
  console.log(jawab);

  if (jawab.msg=="ok") {

    var jumlah = jawab['data'].length;

    var isi = '';
    
    var no = 1;
    for (var i=0; i<jumlah; i++) {
        isi = isi + "<tr><td>"+no+"</td><td>"+jawab['data'][i]['nama']+"</td><td>"+jawab['data'][i]['jk']+"</td><td>"+set_tanggal(jawab['data'][i]['tanggal_lahir'])+"</td><td>"+set_tanggal(jawab['data'][i]['tanggal_wafat'])+"</td><td>"+jawab['data'][i]['sektor']+"</td></tr>";
        no++;
    }

    $("#tblWafat tbody").html(isi);
  
    $(".btn-print").show();


  }


}
