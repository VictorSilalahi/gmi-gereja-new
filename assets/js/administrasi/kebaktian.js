import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo } from "../format.js";

let base_url = $("#base_url").val()+"api/intern/"

$(document).ready(function () {

  check_token();
  
  $.LoadingOverlay("show");
  
  // loadDataKegiatan();
  lihatKebaktianBulanIni();

  $.LoadingOverlay("hide");

});


function lihatKebaktianBulanIni() {

  var jawab = ajax_get(base_url+"kebaktian/bulanini", "");

  console.log(jawab);

  var data = jawab.data;

  var str = '';
  var no = 1;
  for (var i=0; i<data.length; i++) {

    str = str + "<tr id='"+data[i]['kebaktian_id']+"'><td>"+no+"</td><td>"+set_tanggal(data[i]['tanggal'])+"</td>";

    var kebaktian = data[i]['data'];

    if (kebaktian!==null) {

      str = str + "<td>&#10004;</td><td></td></tr>";

    } else {

      str = str + "<td></td><td><button class='btn btn-info btn-tambah-data-kebaktian'>Isi Data Kebaktian</button></td></tr>";
    }

    no++;

  }

  $("#tblKebaktian tbody").html(str);

}

function loadDataKegiatan() {
  $("#tblKegiatan tbody tr").remove();

  var data = ajax_get(base_url+"kegiatan/all", "");

  // console.log(data);

  if (data.msg == "ok") {
    var isi_tabel = "";
    var no = 1;
    for (var i = 0; i < data.data.length; i++) {
      isi_tabel =
        isi_tabel +
        "<tr id='" +
        data.data[i]["kegiatan_id"] +
        "'><td>" +
        no +
        "</td><td>" +
        set_tanggal(data.data[i]["tanggal"]) +
        "</td><td>" +
        data.data[i]["judul_kegiatan"] +
        "<td><button class='btn btn-secondary btn-edit'>Edit</button>&nbsp;<button class='btn btn-danger btn-delete'>Hapus</button></td></tr>";
      no++;
    }
    $("#tblKegiatan tbody").html(isi_tabel);
  }
}

