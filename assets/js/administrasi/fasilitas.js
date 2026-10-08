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



function loadDataFasilitas() {

  // let identity_link = sessionStorage.getItem("identity_link");

  // console.log(identity_link);

  // var data = ajax_post(base_url+"fasilitas", {"identity_link": identity_link});

  // console.log(data);

  if (data.msg == "ok") {
      // console.log(data["Gedung_Gereja"]);

      $("#Gedung_Gereja").prop("checked", data["Gedung_Gereja"]);

  }


}

