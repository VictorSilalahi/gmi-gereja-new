import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal_indo, set_tanggal, set_tanggal_database } from "../format.js";
import { createPDF } from "../report.js";

let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {

  check_token();
  
  $(".btn-print").hide();

  loadDataSektor();

});

$(document).on("change", "#slcSektor", function () {

  var sektor_id = $(this).val();

  loadDataPerSektor(sektor_id);

});

$(document).on("click", ".btn-print", function(e) {

  var nama_sektor = $("#slcSektor option:selected").text();
  var header = "<p><h3>Report Jemaat per Sektor</h3></p><p><h4>Sektor : "+nama_sektor+"</h4></p>";
  createPDF("bodyReport", header, "p", "Report_Jemaat_Per_Sektor");


});

function loadDataSektor() {

  var data = ajax_get(base_url+"sektor/all", "");

  if (data.msg == "ok") {
    var isi_select = "<option value=''>-</option>";

    for (var i = 0; i < data.data.length; i++) {

        isi_select = isi_select + "<option value='"+data.data[i]['sektor_id']+"'>"+data.data[i]['no_sektor']+"|"+data.data[i]['nama_sektor']+"</option>";

    }
    $("#slcSektor").html(isi_select);
  }
}

function loadDataPerSektor(sektor_id) {

  var jawab = ajax_get("/administrasi/jemaat/sektor", {"sektor_id": sektor_id });

  $("#tblJemaat tbody").html("");
  $(".btn-print").hide();
  
  if (jawab.msg=="ok") {

    // console.log(jawab.data);
    var jumlah = jawab['data'].length;

    var isi = '';
    
    var no = 1;
    for (var i=0; i<jumlah; i++) {
        isi = isi + "<tr class='table-primary'><td>"+no+"</td><td>"+jawab['data'][i]['nik']+"</td><td colspan='6'>"+jawab['data'][i]['alamat']+"</td><td>"+jawab['data'][i]['jumlah']+"</td><td>"+jawab['data'][i]['status_keanggotaan']+"</td></tr>";
        // console.log("Jumlah anggota keluarga = ", jawab['data'][i]['jumlah']);
        for (var j=0; j<parseInt(jawab['data'][i]['jumlah']); j++) {
          
          let tgl_lahir = '...';
          let tgl_baptis = '...';
          let tgl_sidi = '...';
          let tgl_menikah = '...';

          console.log("data:", jawab['data'][i]['nama_anggota_keluarga'][j]);

          if (jawab['data'][i]['nama_anggota_keluarga'][j]['tgl_lahir']) {
            tgl_lahir = set_tanggal(jawab['data'][i]['nama_anggota_keluarga'][j]['tgl_lahir']);
          }

          if (jawab['data'][i]['nama_anggota_keluarga'][j]['tgl_baptis']) {
            tgl_baptis = set_tanggal(jawab['data'][i]['nama_anggota_keluarga'][j]['tgl_baptis']);
          }

          if (jawab['data'][i]['nama_anggota_keluarga'][j]['tgl_sidi']) {
            tgl_sidi = set_tanggal(jawab['data'][i]['nama_anggota_keluarga'][j]['tgl_sidi']);
          }

          if (jawab['data'][i]['nama_anggota_keluarga'][j]['tgl_menikah']) {
            tgl_menikah = set_tanggal(jawab['data'][i]['nama_anggota_keluarga'][j]['tgl_menikah']);
          }

          isi = isi + "<tr style='font-size:14px'><td></td><td></td><td></td><td>"+jawab['data'][i]['nama_anggota_keluarga'][j]['nama']+"</td><td>"+tgl_lahir+"</td><td>"+tgl_baptis+"</td><td>"+tgl_sidi+"</td><td>"+tgl_menikah+"</td><td></td><td></td></tr>";
        }

        no++;
    }

    $("#tblJemaat tbody").html(isi);
  
    $(".btn-print").show();
  }
}


