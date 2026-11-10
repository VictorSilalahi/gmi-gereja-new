import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { pesan_error } from "../pesan.js";


let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {
  check_token();

  $.LoadingOverlay("show");

  // loadDataAnggotaOrganisasi();
  loadAutoComplete();

  $.LoadingOverlay("hide");

});




$(document).on("change", "#slcSeksi", function() {

  let organisasi = $("#slcSeksi").val();

  loadDataAnggotaOrganisasi(organisasi);


});


$(document).on("click", ".btn-delete-anggota_organisasi", function() {


  if (confirm("Apakah akan menghapus data anggota organisasi ini?")==true) {

    let organisasi = $(this).parent().prev().text();

    if (organisasi=='SM') {

      alert("Anggota SM tidak bisa dihapus!");
      return false;

    }

    var anggotaorganisasi_id = $(this).parent().parent().attr("id");

    var jawab = ajax_post(base_url+"organisasi/anggota/del", {"anggotaorganisasi_id": anggotaorganisasi_id });

    if (jawab.msg=="ok") {
      loadDataAnggotaOrganisasi(organisasi);
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
    var nama_organisasi = $("#slcSeksiForm option:selected").text();
    var jawab = ajax_post(base_url+"organisasi/anggota/add", {"nama":nama, "organisasi": nama_organisasi });

   
    if (jawab.msg=="ok") {
      loadDataAnggotaOrganisasi(nama_organisasi);
    } else {
      pesan_error("Saudara/i "+nama+" telah masuk di dalam "+nama_organisasi);
    }
  
  }

});




function loadDataAnggotaOrganisasi(organisasi) {
  $("#tblAnggotaOrganisasi tbody tr").remove();

  var data = ajax_post(base_url+"organisasi/anggota", {"organisasi": organisasi});

  console.log(data);
  
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
