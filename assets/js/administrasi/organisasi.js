import { ajax_get, ajax_post, check_token } from "../ajx.js";


let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {
  check_token();
  loadDataOrganisasi();
  loadDataAnggotaOrganisasi();
  loadAutoComplete();

});

$(document).on("click", ".btn-delete", function () {
  if (confirm("Apakah akan menghapus data organisasi ini?")) {
    var organisasi_id = $(this).parent().parent().attr("id");
    var jawab = ajax_post(base_url+"organisasi/del", { organisasi_id: organisasi_id });

    if (jawab.msg == "error") {
      alert("Data organisasi ini tidak bisa dihapus! Telah dipakai!");
      return false;
    } else {
      loadDataOrganisasi();
      loadDataAnggotaOrganisasi();
    }

  }

});

$(document).on("click", ".btn-edit", function () {
    var organisasi_id = $(this).parent().parent().attr("id");
    var nama = $(this).parent().parent().find("td:eq(1)").text();

    $("#opOrganisasi").text("Edit Organisasi");
    $("#txtJenisOpOrganisasi").val("edit");
    $("#txtNamaOrganisasi").val(nama);
    $("#txtOrganisasiID").val(organisasi_id);
    $("#AddEditOrganisasi").modal("show");
});

$(document).on("click", "#btnTambahOrganisasi", function () {
  $("#opOrganisasi").text("Tambah Organisasi");
  $("#txtJenisOpOrganisasi").val("tambah");
  $("#AddEditOrganisasi").modal("show");

});

$(document).on("click", "#btnOKOrganisasi", function () {
  if ($("#txtNamaOrganisasi").val() == "") {
    alert("Masukkan nama organisasi!");
    $("#txtNamaOrganisasi").focus();
    return false;
  }


  if ($("#txtJenisOpOrganisasi").val() == "tambah") {
    var data = ajax_post(base_url+"organisasi/add", { nama: $("#txtNamaOrganisasi").val() });
    if (data.msg == "error") {
      alert(data.data);

    } else {
      loadDataOrganisasi();
      loadDataAnggotaOrganisasi();
      $("#txtNamaOrganisasi").val("");
      $("#AddEditOrganisasi").modal("hide");

    }

  } else {
    var data = ajax_post(base_url+"organisasi/change", { organisasi_id: $("#txtOrganisasiID").val(), nama: $("#txtNamaOrganisasi").val() });
    if (data.msg == "error") {
      alert(data.data);

    } else {
      loadDataOrganisasi();
      loadDataAnggotaOrganisasi();
      $("#txtNamaOrganisasi").val("");
      $("#AddEditOrganisasi").modal("hide");

    }

  }

});

$(document).on("click", ".btn-delete-anggota_organisasi", function() {


  if (confirm("Apakah akan menghapus data anggota organisasi ini?")==true) {
    var anggotaorganisasi_id = $(this).parent().parent().attr("id");

    var jawab = ajax_post(base_url+"organisasi/anggota/del", {"anggotaorganisasi_id": anggotaorganisasi_id });

    if (jawab.msg=="ok") {
      loadDataAnggotaOrganisasi();
      loadDataAnggotaOrganisasi();
    } else {
      alert(jawab.data);
    }
  
  }

});


$(".btn-ok-tambah-anggota-organisasi").on("click", function() {

  if ($("#txtNamaCalonAnggota").val()=='') {
    alert("Pilih nama calon anggota organisasi!");
    $("#txtNamaCalonAnggota").focus();
    return false;
  }

  if (confirm("Apakah akan menginput data anggota organisasi?")==true) {
    var nama = $("#txtNamaCalonAnggota").val();
    var organisasi_id = $("#slcOrganisasiForm").val();
    var jawab = ajax_post(base_url+"organisasi/anggota/add", {"nama":nama, "organisasi_id": organisasi_id });

    if (jawab.msg=="ok") {
      loadDataAnggotaOrganisasi();
    } else {
      alert(jawab.data);
    }
  
  }

});




function loadDataOrganisasi() {
  $("#tblOrganisasi tbody tr").remove();

  var data = ajax_get(base_url+"organisasi/all", "");

  if (data.msg == "ok") {
    var isi_tabel = "";
    var isi_select = "";
    var no = 1;
    for (var i = 0; i < data.data.length; i++) {
      isi_tabel =
        isi_tabel +
        "<tr id='" +
        data.data[i]["organisasi_id"] +
        "'><td>" +
        no +
        "</td><td>" +
        data.data[i]["organisasi"] +
        "</td>" +
        "<td><button class='btn btn-secondary btn-edit'>Edit</button>&nbsp;<button class='btn btn-danger btn-delete'>Hapus</button></td></tr>";
      no++;

      isi_select = isi_select + "<option value='"+data.data[i]['organisasi_id']+"'>"+data.data[i]['organisasi']+"</option>";

    }

    $("#tblOrganisasi tbody").html(isi_tabel);
    $("#slcOrganisasiForm").html(isi_select);

  }

}

function loadDataAnggotaOrganisasi() {
  $("#tblAnggotaOrganisasi tbody tr").remove();

  var data = ajax_get(base_url+"organisasi/anggota", "");

  if (data.msg == "ok") {
    var isi_tabel = "";
    var no = 1;

    for (var i = 0; i < data.data.length; i++) {
      isi_tabel =
        isi_tabel +
        "<tr id='" +
        data.data[i]["anggotaorganisasi_id"] +
        "'><td>" +
        no +
        "</td><td>" +
        data.data[i]["nama"] +
        "</td>" +
        "<td>" + data.data[i]['organisasi'] + "</td>" +
        "<td>&nbsp;<button class='btn btn-danger btn-delete-anggota_organisasi'>Hapus</button></td></tr>";
      no++;
    }
    $("#tblAnggotaOrganisasi tbody").html(isi_tabel);
  }
}

function loadAutoComplete() {
  var data = ajax_get(base_url+"jemaat/anggota/all", "");

  var daftar_nama  = [];

  for (var i=0; i<data.data.length; i++) {
    daftar_nama.push(data.data[i]['nama']);
  }
  
  $("#txtNamaCalonAnggota").autocomplete({
    source: daftar_nama,
    autoFocus:true
  });
}
