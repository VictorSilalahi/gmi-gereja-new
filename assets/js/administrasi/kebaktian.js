import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_database, set_tanggal_indo } from "../format.js";

let base_url = $("#base_url").val()+"api/intern/"

$(document).ready(function () {

  check_token();
  
  $.LoadingOverlay("show");
  
  loadKebaktianBulanIni();

  $.LoadingOverlay("hide");

});


$(document).on("click", ".btn-tambah-data-kebaktian", function() {

  let tanggal = $(this).parent().prev().prev().text();
  $("#txtTanggalMinggu").html("<h4><span class='badge text-bg-secondary'>"+tanggal+"</span></h4>");
  $("#AddKebaktian").modal("show");

});


$(document).on("click", "#btnOKKebaktian", function() {

  let base_url = $("#base_url").val()+"api/intern/";

  let ask = confirm("Input data kebaktian minggu?");

  let data = [];
  
  let kebaktian = null;
  
  if (ask) {

    kebaktian = [];
    for (let i=0; i<5; i++) {

      let no_kebaktian = $("#tblInputKebaktian tbody tr:eq("+i+") td:eq(0)").text();
      let kehadiran = $("#tblInputKebaktian tbody tr:eq("+i+") td:eq(1) input").val();
      let persembahan = $("#tblInputKebaktian tbody tr:eq("+i+") td:eq(2) input").val();
      kebaktian.push({"sesi_kebaktian": no_kebaktian, "kehadiran": kehadiran, "persembahan": persembahan});

    }

  }

  data['tanggal'] = set_tanggal_database($("#txtTanggalMinggu").text());
  data['kebaktian'] = kebaktian;
  
  let jawab = ajax_post(base_url+"kebaktian/add", {"tanggal": data['tanggal'], "data": data['kebaktian']});

  if (jawab.msg=='ok') {

    loadKebaktianBulanIni();

  }

});

function loadKebaktianBulanIni() {

  var jawab = ajax_get(base_url+"kebaktian/bulanini", "");

  console.log(jawab);

  var data = jawab.data;
  var str = '';
  var no = 1;
  for (var i=0; i<data.length; i++) {


    var kebaktian = data[i]['data'];

    if (kebaktian!==null) {

      str = str + "<tr id='"+data[i]['kebaktian_id']+"'><td>"+no+"</td><td>"+set_tanggal(data[i]['tanggal'])+"</td>";
      str = str + "<td>&#10004;</td><td></td></tr>";

    } else {

      str = str + "<tr id='"+data[i]['kebaktian_id']+"' class='table-warning text-white'><td>"+no+"</td><td>"+set_tanggal(data[i]['tanggal'])+"</td>";
      str = str + "<td></td><td><button class='btn btn-info btn-tambah-data-kebaktian'>Isi Data Kebaktian</button></td></tr>";
    }

    no++;

  }

  $("#tblKebaktian tbody").html(str);
  $("#AddKebaktian").modal("hide");

}

