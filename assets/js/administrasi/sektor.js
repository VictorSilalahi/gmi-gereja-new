import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";

$(document).ready(function () {

  check_token();

  $.LoadingOverlay("show");
  loadData();
  $.LoadingOverlay("hide");
  
});

$(document).on("click", ".btn-delete", function () {

  let base_url = $("#base_url").val()+"api/intern/";

  if (confirm("Apakah akan menghapus data sektor ini?")) {
    var sektor_id = $(this).parent().parent().attr("id");

    var jawab = ajax_post(base_url+"sektor/del", { sektor_id: sektor_id });
    if (jawab.msg == "error") {
      alert("Data sektor ini tidak bisa dihapus! Telah dipakai!");
      return false;
    } else {
      loadData();
    }

  }
});

$(document).on("click", ".btn-edit", function () {

    
    var sektor_id = $(this).parent().parent().attr("id");
    var no_sektor = $(this).parent().parent().find("td:eq(1)").text();
    var nama_sektor = $(this).parent().parent().find("td:eq(2)").text();

    $("#opSektor").text("Edit Sektor");
    $("#txtJenisOpSektor").val("edit");
    $("#txtNomorSektor").val(no_sektor);
    $("#txtNamaSektor").val(nama_sektor);
    $("#txtSektorID").val(sektor_id);
    $("#AddEditSektor").modal("show");
});

$(document).on("click", "#btnTambahSektor", function () {
  $("#opSektor").text("Tambah Sektor");
  $("#txtJenisOpSektor").val("tambah");
  $("#AddEditSektor").modal("show");
});

$(document).on("click", "#btnOKSektor", function () {

  let base_url = $("#base_url").val()+"api/intern/";

  if ($("#txtNomorSektor").val() == "") {
    alert("Masukkan nomor Sektor!");
    $("#txtNomorSektor").focus();
    return false;
  }

  if ($("#txtNamaSektor").val() == "") {
    alert("Masukkan nama Sektor!");
    $("#txtNamaSektor").focus();
    return false;
  }

  if ($("#txtJenisOpSektor").val() == "tambah") {
    var data = ajax_post(base_url+"sektor/add", { no_sektor: $("#txtNomorSektor").val(), nama_sektor: $("#txtNamaSektor").val() });
    if (data.msg == "error") {
      alert(data.data);
    } else {
      loadData();
      $("#txtNomorSektor").val("");
      $("#txtNamaSektor").val('');
      $("#AddEditSektor").modal("hide");
    }
  } else {
    var data = ajax_post(base_url+"sektor/change", { sektor_id: $("#txtSektorID").val(), no_sektor: $("#txtNomorSektor").val(), nama_sektor: $("#txtNamaSektor").val() });
    if (data.msg == "error") {
      alert(data.data);
    } else {
      loadData();
      $("#txtNomorSektor").val("");
      $("#txtNamaSektor").val("");
      $("#AddEditSektor").modal("hide");
    }
  }
});

function loadData() {
  $("#tblSektor tbody tr").remove();

  let api_url = $("#base_url").val()+"api/intern/sektor/all"

  var data = ajax_get(api_url, "");

  if (data.msg == "ok") {
    var isi_tabel = "";
    var no = 1;
    for (var i = 0; i < data.data.length; i++) {
      isi_tabel =
        isi_tabel +
        "<tr id='" +
        data.data[i]["sektor_id"] +
        "'><td>" +
        no +
        "</td><td>" +
        data.data[i]["no_sektor"] +
        "</td><td>" +
        data.data[i]["nama_sektor"] +
        "<td><button class='btn btn-secondary btn-edit'>Edit</button>&nbsp;<button class='btn btn-danger btn-delete'>Hapus</button></td></tr>";
      no++;
    }
    $("#tblSektor tbody").html(isi_tabel);
  }
}
