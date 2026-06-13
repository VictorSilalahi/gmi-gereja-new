import { ajax_get, ajax_post } from "../ajx.js";
import { createPDF } from "../report.js";


$(document).ready(function () {

  $(".btn-print").hide();
  
  loadDataPejabat();

});


$(document).on("click", ".btn-print", function(e) {

  var header = "<p><h3>Report Pejabat</h3></p>";
  createPDF("bodyReport", header, "p", "Report_Pejabat");

});

function loadDataPejabat() {

  var jawab = ajax_get("/administrasi/pejabat/all", {});

  $("#tblPejabat tbody").html("");
  $(".btn-print").hide();
  
  console.log(jawab);

  if (jawab.msg=="ok") {

    var jumlah = jawab['data'].length;

    var isi = '';
    
    var no = 1;
    for (var i=0; i<jumlah; i++) {
        isi = isi + "<tr><td>"+no+"</td><td>"+jawab['data'][i]['nama']+"</td><td>"+jawab['data'][i]['jabatan']+"</td></tr>";
        no++;
    }

    $("#tblPejabat tbody").html(isi);
  
    $(".btn-print").show();
  }


}

