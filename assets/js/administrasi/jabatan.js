import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";


$(document).ready(function () {

  check_token();

  $.LoadingOverlay("show");

  loadAutoComplete();

  $.LoadingOverlay("hide");

});


$(document).on("change", "#slcPelayan", function() {


  let jabatan = $(this).val();

  loadDataPejabat(jabatan);  


});


$(document).on("click", ".btn-delete-pejabat", function() {

  let base_url = $("#base_url").val()+"api/intern/";

  var pejabat_id = $(this).parent().parent().attr("id");

  if (confirm("Apakah akan menghapus data pejabat ini?")) {

    var data = ajax_post(base_url+"jabatan/pejabat/del", {"pejabat_id": pejabat_id});

    if (data.msg=="error") {
      alert(data.data);

    } else {
      loadDataPejabat();
      
    }
  }

});



$(".btn-ok-tambah-anggota-pelayan").on("click", function() {
  
  let base_url = $("#base_url").val()+"api/intern/";

  if ($("#txtNamaCalonPelayan").val()=='') {
    alert("Masukkan nama calon pelayan!");
    $("#txtNamaCalonPelayan").focus();
    return false;
  
  }

  if ($("#tglPengangkatan").val()=='') {
    alert("Masukkan tanggal pengangkatan!");
    $("#tglPengangkatan").focus();
    return false;

  }

  var nama_pejabat = $("#txtNamaCalonPelayan").val();
  // var jabatan_id = $("#slcJabatanForm").val();
  var tgl_pengangkatan = $("#tglPengangkatan").val();
  let jabatan = $("#slcFormPelayan option:selected").text();

  var data = ajax_post(base_url+"jabatan/pejabat/add", { "nama": nama_pejabat, "jabatan": jabatan, "tanggal_pengangkatan": tgl_pengangkatan });

  if (data.msg=='ok') {
    $("#txtNamaCalonPelayan").val("");
    loadDataPejabat(jabatan)
  
  } else {

    pesan_error("Saudara/i "+nama_pejabat+" sudah menjabat di "+jabatan);

  }

});



$(document).on("click", ".btn-berhenti-pejabat", function() {

  let nama_pejabat = $(this).parent().prev().prev().text();
  let pejabat_id = $(this).parent().parent().attr("id");

  $("#nama_pejabat").val(nama_pejabat);
  $("#pejabat_id").val(pejabat_id);

  $("#frmBerhentiJabatan").modal("show");

});

$(document).on("click", "#btnBerhentiJabatan", function() {

  let jabatan = $("#slcFormPelayan option:selected").val();
  let nama_pejabat = $("#nama_pejabat").val();
  let pejabat_id = $("#pejabat_id").val();

  let base_url = $("#base_url").val();

  if ($("#txtTanggalBerhenti").val()=='') {

    pesan_error("Masukkan tanggal berhenti!");
    return false;

  }

  let tanggal_berhenti = $("#txtTanggalBerhenti").val();

  let data = ajax_post(base_url+"api/intern/jabatan/pejabat/del", {"nama_pejabat": nama_pejabat, "pejabat_id": pejabat_id, "tanggal_berhenti": tanggal_berhenti});

  if (data.msg=='ok') {

      $("#frmBerhentiJabatan").modal("hide");
      loadDataPejabat();
    
  }  


});




function loadDataPejabat(jabatan) {

  let base_url = $("#base_url").val()+"api/intern/";

  $("#tblPejabat tbody").html("");


  var data = ajax_post(base_url+"jabatan/pejabat/all", {"jabatan": jabatan});

  // console.log(data);

  if (data.msg == "ok") {
    var isi_tabel = "";
    var no = 1;
    for (var i = 0; i < data.data.length; i++) {
      isi_tabel = isi_tabel+"<tr id='"+data.data[i]["pejabat_id"]+"'><td>"+no+"</td><td>"+data.data[i]["nama"]+"</td>";
      isi_tabel = isi_tabel+"<td>"+data.data[i]["jabatan"]+"</td>";
      isi_tabel = isi_tabel+"<td>&nbsp;<button class='btn btn-warning btn-berhenti-pejabat'>Berhenti</button></td></tr>";
      no++;

    }

    $("#tblPejabat tbody").html(isi_tabel);

  }

}

function loadAutoComplete() {

  let base_url = $("#base_url").val()+"api/intern/";

  var data = ajax_get(base_url+"jemaat/anggota/all", "");

  // console.log(data);
  var daftar_nama  = [];

  for (var i=0; i<data.data.length; i++) {
    daftar_nama.push(data.data[i]['nama']);
  }
  
  $("#txtNamaCalonPelayan").autocomplete({
    source: daftar_nama,
    autoFocus:true
  });

}