import { ajax_get, ajax_post } from "../ajx.js";


$(document).ready(function () {
  loadDataJabatan();
  loadDataPejabat();
  loadAutoComplete();
});

$(document).on("click", ".btn-delete", function () {
  if (confirm("Apakah akan menghapus data jabatan ini?")) {
    var jabatan_id = $(this).parent().parent().attr("id");
    var jawab = ajax_post("jabatan/del", { jabatan_id: jabatan_id });
    if (jawab.msg == "error") {
      alert("Data jabatan ini tidak bisa dihapus! Telah dipakai!");
      return false;
    } else {
      loadDataJabatan();
      loadDataPejabat();
    }

  }
});

$(document).on("click", ".btn-edit", function () {
  var jabatan_id = $(this).parent().parent().attr("id");
  var jabatan = $(this).parent().parent().find("td:eq(1)").text();
  $("#opJabatan").text("Edit Jabatan");
  $("#txtJenisOpJabatan").val("edit");
  $("#txtNamaJabatan").val(jabatan);
  $("#txtJabatanID").val(jabatan_id);
  $("#AddEditJabatan").modal("show");
});

$(document).on("click", "#btnTambahJabatan", function () {
  $("#opJabatan").text("Tambah Jabatan");
  $("#txtJenisOpJabatan").val("tambah");
  $("#AddEditJabatan").modal("show");
});

$(document).on("click", ".btn-delete-pejabat", function() {


  var pejabat_id = $(this).parent().parent().attr("id");

  if (confirm("Apakah akan menghapus data pejabat ini?")) {

    var data = ajax_post("pejabat/del", {"pejabat_id": pejabat_id});

    if (data.msg=="error") {
      alert(data.data);
    } else {
      loadDataPejabat();
    }
  }

});


$(document).on("click", "#btnOKJabatan", function () {
  if ($("#txtNamaJabatan").val() == "") {
    alert("Masukkan nama jabatan!");
    $("#txtNamaJabatan").focus();
    return false;
  }


  if ($("#txtJenisOpJabatan").val() == "tambah") {
    
    var data = ajax_post("jabatan/add", { jabatan: $("#txtNamaJabatan").val() });
    if (data.msg == "error") {
      alert(data.data);
    } else {
      loadDataJabatan();
      loadDataPejabat();
      $("#txtNamaJabatan").val("");
      $("#AddEditJabatan").modal("hide");
    }
  } else {
    var data = ajax_post("jabatan/change", { jabatan_id: $("#txtJabatanID").val(), jabatan: $("#txtNamaJabatan").val() });
    if (data.msg == "error") {
      alert(data.data);
    } else {
      loadDataJabatan();
      loadDataPejabat();
      $("#txtNamaJabatan").val("");
      $("#AddEditJabatan").modal("hide");
    }
  }


});

$(".btn-ok-tambah-pejabat").on("click", function() {
  
  if ($("#txtNamaPejabat").val()=='') {
    alert("Masukkan nama pejabat!");
    $("#txtNamaPejabat").focus();
    return false;
  }

  var nama_pejabat = $("#txtNamaPejabat").val();
  var jabatan_id = $("#slcJabatanForm").val();

  var data = ajax_post("pejabat/add", { "nama": nama_pejabat, "jabatan_id": jabatan_id });

  if (data.msg=='ok') {
    loadDataPejabat()
  }  

});

function loadDataJabatan() {
  $("#tblJabatan tbody tr").remove();

  var data = ajax_get("jabatan/all", "");

  if (data.msg == "ok") {
    var isi_tabel = "";
    var isi_select = "";
    var no = 1;
    for (var i = 0; i < data.data.length; i++) {
      isi_tabel =
        isi_tabel +
        "<tr id='" +
        data.data[i]["jabatan_id"] +
        "'><td>" +
        no +
        "</td><td>" +
        data.data[i]["jabatan"] +
        "</td><td><button class='btn btn-secondary btn-edit'>Edit</button>&nbsp;<button class='btn btn-danger btn-delete'>Hapus</button></td></tr>";
      no++;

      isi_select = isi_select + "<option value='"+data.data[i]['jabatan_id']+"'>"+data.data[i]['jabatan']+"</option>";

    }
    $("#tblJabatan tbody").html(isi_tabel);
    $("#slcJabatanForm").html(isi_select);
  }
}

function loadDataPejabat() {
  $("#tblPejabat tbody tr").remove();

  var data = ajax_get("pejabat/all", "");

  if (data.msg == "ok") {
    var isi_tabel = "";
    var no = 1;
    for (var i = 0; i < data.data.length; i++) {
      isi_tabel = isi_tabel+"<tr id='"+data.data[i]["pejabat_id"]+"'><td>"+no+"</td><td>"+data.data[i]["nama"]+"</td>";
      isi_tabel = isi_tabel+"<td>"+data.data[i]["jabatan"]+"</td>";
      isi_tabel = isi_tabel+"<td>&nbsp;<button class='btn btn-danger btn-delete-pejabat'>Hapus</button></td></tr>";
      no++;


    }
    $("#tblPejabat tbody").html(isi_tabel);
  }

}

function loadAutoComplete() {
  var data = ajax_get("jemaat/anggota/all", "");

  // console.log(data);
  var daftar_nama  = [];

  for (var i=0; i<data.data.length; i++) {
    daftar_nama.push(data.data[i]['nama']);
  }
  
  $( "#txtNamaPejabat" ).autocomplete({
    source: daftar_nama,
    autoFocus:true
  });
}