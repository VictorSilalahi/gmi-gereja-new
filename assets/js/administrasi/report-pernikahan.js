import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { createPDF } from "../report.js";
import { set_tanggal, set_tanggal_database, set_tanggal_indo } from "../format.js";

let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {

    check_token();
    $(".btn-print").hide();

});

$(document).on("click", ".btn-prosesdata", function () {

    if ($("#tglAwal").val()=='') {
        alert("Masukkan tanggal awal!");
        $("#tglAwal").focus();
        return false;
    }

    if ($("#tglAkhir").val()=='') {
        alert("Masukkan tanggal akhir!");
        $("#tglAkhir").focus();
        return false;
    }

    var tgl_awal = $("#tglAwal").val();
    var tgl_akhir = $("#tglAkhir").val();

    var jawab = ajax_post(base_url+"report/jemaat/pernikahan", {"tgl_awal": tgl_awal, "tgl_akhir": tgl_akhir });

    console.log(jawab);
    
    $("#tblJemaat tbody").html("");
    $(".btn-print").hide();
    
    if (jawab.msg=="ok") {

        var jumlah = jawab['data'].length;

        var isi = '';
        
        var no = 1;
        for (var i=0; i<jumlah; i++) {
            var tgl_menikah = set_tanggal(jawab['data'][i]['tanggal_menikah']);
            isi = isi + "<tr><td>"+no+"</td><td>"+jawab['data'][i]['nama']+"</td><td>"+tgl_menikah+"</td><td>"+jawab['data'][i]['alamat']+"</td><td>"+jawab['data'][i]['sektor']+"</td></tr>";
            no++;
        }

        $("#tblJemaat tbody").html(isi);
    
        $(".btn-print").show();

    }

});

$(document).on("click", ".btn-print", function(e) {

  var header = "<p><h3>Report Tanggal Pernikahan</h3></p>";
  createPDF("bodyReport", header, "p", "Pernikahan");


});





