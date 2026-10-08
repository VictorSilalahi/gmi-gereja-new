import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal } from "../format.js";

let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {

  check_token();
  
  $.LoadingOverlay("show");
  
  loadDataFasilitas();

  $.LoadingOverlay("hide");

});



$(document).on("click", "#btnTambahKegiatan", function () {
  $("#opKegiatan").text("Tambah Kegiatan");
  $("#txtJenisOpKegiatan").val("tambah");
  $("#AddEditKegiatan").modal("show");

});


$(document).on("click", "#btnOKKegiatan", function () {

  if ($("#txtTanggal").val()=='') {
    alert("Masukkan tanggal kegiatan!");
    $("#txtTanggal").focus();
    return false;
  }

  if ($("#txtJudul").val()=='') {
    alert("Masukkan judul kegiatan!");
    $("#txtJudul").focus();
    return false;
  }

  if ($("#txtDeskripsi").val()=='') {
    alert("Masukkan deskripsi kegiatan!");
    $("#txtDeskripsi").focus();
    return false;
  }

  var tanggal = $("#txtTanggal").val();
  var judul = $("#txtJudul").val();
  var deskripsi = $("#txtDeskripsi").val();

  var jawab;

  if ($("#txtJenisOpKegiatan").val()=='tambah') {

    jawab = ajax_post(base_url+"kegiatan/add", {"tanggal": tanggal, "judul": judul, "deskripsi": deskripsi});

  } else {

    var kegiatan_id = $("#txtKegiatanID").val();
    jawab = ajax_post("kegiatan/change", {"tanggal": tanggal, "judul": judul, "deskripsi": deskripsi, "kegiatan_id": kegiatan_id});

  } 


  if (jawab.msg=='ok') {
    loadDataKegiatan();
    $("#AddEditKegiatan").modal("hide");

  } else {

    alert("Input kegiatan error!");
    $("#txtTanggal").focus();

  }


});


$(document).on("click", ".btn-delete", function() {

  if (confirm("Apakah akan menghapus data kegiatan ini?")) {
    var kegiatan_id = $(this).parent().parent().attr("id");
    var jawab = ajax_post(base_url+"kegiatan/del", {kegiatan_id: kegiatan_id });

    loadDataKegiatan();
    
    if (jawab.msg == "error") {
      alert("Data kegiatan ini tidak bisa dihapus!");
      return false;

    } 

  }

});

$(document).on("click", ".btn-edit", function () {
    var kegiatan_id = $(this).parent().parent().attr("id");

    var jawab = ajax_get("kegiatan/get", {"kegiatan_id": kegiatan_id})

    if (jawab.msg=='ok') {

      var tanggal = jawab.data[0]["tanggal"];
      var judul = jawab.data[0]["judul"];
      var deskripsi = jawab.data[0]["deskripsi"];

      $("#opKegiatan").text("Edit Kegiatan");
      $("#txtJenisOpKegiatan").val("edit");
      $("#txtKegiatanID").val(kegiatan_id);

      $("#txtTanggal").val(tanggal);
      $("#txtJudul").val(judul);
      $("#txtDeskripsi").val(deskripsi);
      $("#AddEditKegiatan").modal("show");

    }

});


function loadDataFasilitas() {
  $("#tblKegiatan tbody tr").remove();

  let identity_link = sessionStorage.getItem("identity_link");

  var data = ajax_post(base_url+"fasilitas", {"identity_link": identity_link});

  console.log(data);

  if (data.msg == "ok") {



  }


}

