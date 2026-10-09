import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal } from "../format.js";

let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {

  check_token();
  
  $.LoadingOverlay("show");
  
  loadDataFasilitas();

  $.LoadingOverlay("hide");

});



$(document).on("change", ".form-check-input", function () {

  let field_name = $(this).attr("id");

  let nilai = $("#"+field_name).is(":checked");

  let temp = ajax_post(base_url+"fasilitas/ubah", {"field_name": field_name, "nilai": nilai});


});



function loadDataFasilitas() {

  var temp = ajax_post(base_url+"fasilitas", {});

  // console.log(data);

  if (temp.msg == "ok") {
      let data = temp.data;
      // alert(data["Gedung_Gereja"]);
      if (data["Gedung_Gereja"]==1) {
        $("#Gedung_Gereja").prop("checked", true);
      } 
      if (data["Pastori"]==1) {
        $("#Pastori").prop("checked", true);
      } 
      if (data["Gedung_Sekolah_Minggu"]==1) {
        $("#Gedung_Sekolah_Minggu").prop("checked", true);
      } 
      if (data["Sekolah"]==1) {
        $("#Sekolah").prop("checked", true);
      } 
      if (data["Gedung_Serba_Guna"]==1) {
        $("#Gedung_Serba_Guna").prop("checked", true);
      } 
      if (data["Lahan_Kosong"]==1) {
        $("#Lahan_Kosong").prop("checked", true);
      } 
      if (data["Pemakaman"]==1) {
        $("#Pemakaman").prop("checked", true);
      } 

  }


}

