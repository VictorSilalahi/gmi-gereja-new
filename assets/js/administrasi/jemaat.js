import { ajax_get, ajax_post, check_token } from "../ajx.js";
import { set_tanggal, set_tanggal_indo, set_tanggal_database } from "../format.js";
import { pesan_error, pesan_sukses, pesan_tanya } from "../pesan.js";


$(document).ready(function () {

  
  check_token();
  
  $.LoadingOverlay("show");

  loadDataSektor();

  loadDataSektorForm();

  $("#tblJemaat tbody").html("");

  $.LoadingOverlay("hide");

  check_kebaktian();

});

$(document).on("click", ".ul-edit li", function() {

  var pilih = $(this).text();
  var jemaat_id = $(this).parent().parent().parent().parent().attr("id");

  if (pilih=='Data Umum') {

    loadDataUmum(jemaat_id);

  } else {

    loadDataAnggotaKeluarga(jemaat_id, "edit");

  }


});

$(document).on("change", "#slcSektor", function() {

  var sektor_id = $("#slcSektor").val();

  $.LoadingOverlay("show");

  loadDataJemaat(sektor_id);

  $.LoadingOverlay("hide");

});


$(document).on("click", "#slcSektorForm", function() {

  var temp = $("#slcSektorForm option:selected").text();
  var str_sektor = temp.split("|");
  $("#txtNIKAwal").val(str_sektor[0]);

});


$(document).on("click", "#btnTambahJemaat", function () {
  $("#opJemaat").text("Tambah Jemaat");
  $("#txtJenisOpSektor").val("tambah");
  $("#AddEditJemaat").modal("show");
});

$(document).on("click", ".btn-tambah-calon-anggota", function() {

  if ($("#txtNama").val()=='') {
    alert("Masukkan nama calon anggota!");
    $("#txtNama").focus();
    return false;
  }

  if ($("#txtTanggalLahir").val()=='') {
    alert("Masukkan tanggal lahir!");
    $("#txtTanggalLahir").focus();
    return false;
  }

  var nama = $("#txtNama").val();
  var jk = $("#slcJenisKelamin").val();
  var gol_darah = $("#slcGolonganDarah").val();
  var tgl_lahir = '';
  var check_baptis = null;
  var td_baptis = '';
  var tgl_baptis = '';
  var check_sidi = null;
  var td_sidi = '';
  var tgl_sidi = '';
  var tgl_menikah = '';
  var pendidikan_terakhir = $("#slcPendidikanTerakhir").val();
  var pekerjaan = $("#slcPekerjaan").val();
    
  if ($("#txtTanggalLahir").val()!=='') {
    tgl_lahir = set_tanggal_indo($("#txtTanggalLahir").val());
  }
  check_baptis = $("#chkBaptis").prop("checked");
  if (check_baptis===true) {
    td_baptis = "<td>&#9989;</td>"
  } else {
    td_baptis = "<td></td>";
  }
  if ($("#txtTanggalBaptis").val()!=='') {
    tgl_baptis = set_tanggal_indo($("#txtTanggalBaptis").val());
  }
  check_sidi = $("#chkSidi").prop("checked");
  if (check_sidi===true) {
    td_sidi = "<td>&#9989;</td>";
  } else {
    td_sidi = "<td></td>";
  }
  if ($("#txtTanggalSidi").val()!=='') {
    tgl_sidi = set_tanggal_indo($("#txtTanggalSidi").val());
  }
  if ($("#txtTanggalMenikah").val()!=='') {
    tgl_menikah = set_tanggal_indo($("#txtTanggalMenikah").val());
  }

  var posisi_keluarga = $("#slcPosisi").val();

  var row_to_add = "<tr><td>"+nama+"</td><td>"+jk+"</td><td>"+gol_darah+"</td><td>"+tgl_lahir+"</td>"+td_baptis+"<td>"+tgl_baptis+"</td>"+td_sidi+"<td>"+tgl_sidi+"</td><td>"+tgl_menikah+"</td><td></td><td>"+posisi_keluarga+"</td><td>"+pendidikan_terakhir+"</td><td>"+pekerjaan+"</td><td><button class='btn btn-danger btn-hapus-calon'>Hapus</button></td></tr>";
  $("#tblDaftarCalonJemaat tbody").append(row_to_add);

  $("#txtNama").val("");
  $("#chkBaptis").prop("checked", false);
  $("#txtTanggalBaptis").prop("disabled", true);
  $("#chkSidi").prop("checked", false);
  $("#txtTanggalSidi").prop("disabled", true);
  $("#txtTanggalLahir").val("");
  $("#txtTanggalBaptis").val("");
  $("#txtTanggalSidi").val("");
  $("#txtTanggalMenikah").val("");
  $("#txtNama").focus();

});

$(document).on("change", "#chkBaptis", function() {

    if ($("#chkBaptis").is(':checked')) {
        $("#txtTanggalBaptis").prop("disabled", false);
    } else {
        $("#txtTanggalBaptis").prop("disabled", true);
    }
});

$(document).on("change", "#chkSidi", function() {

    if ($("#chkSidi").is(':checked')) {
        $("#txtTanggalSidi").prop("disabled", false);
    } else {
        $("#txtTanggalSidi").prop("disabled", true);
    }
});

$(document).on("click", "#btnOKJemaat", function () {
  
  let base_url = $("#base_url").val()+"api/intern/";

  if ($("#txtNIKAwal").val()=='') {
    alert("Masukkan nomor NIK Awal. Pilih Sektor!");
    $("#txtNIKAwal").focus();
    return false;
  }

  if ($("#txtNIKAkhir").val()=='') {
    alert("Masukkan nomor NIK Akhir.");
    $("#txtNIKAkhir").focus();
    return false;
  }

  if ($("#txtAlamat").val()=='') {
    alert("Masukkan alamat!");
    $("#txtAlamat").focus();
    return false;
  }

  if ($("#txtMobilePhone").val()=='') {
    alert("Masukkan mobile phone!");
    $("#txtMobilePhone").focus();
    return false;
  }

  if ($("#tblDaftarCalonJemaat tbody tr").length==0) {
    alert("Masukkan data anggota keluarga!");
    $("#txtNama").focus();
    return false;
  }

  var nik = $("#txtNIKAwal").val() + "-" + $("#txtNIKAkhir").val();
  // var tanggal_terdaftar = $("#txtTanggalTerdaftar").val();
  var mobile_phone = $("#txtMobilePhone").val();
  var alamat = $("#txtAlamat").val();
  // var status_keanggotaan = $("#slcStatus").val();
  var sektor_id = $("#slcSektorForm").val();

  var daftar = [];

  for (var i=0; i<$("#tblDaftarCalonJemaat tbody tr").length; i++) {

    var nama = '';
    var gol_darah = '';
    var jk = '';
    var tgl_lahir = '';
    var chk_baptis = false;
    var tgl_baptis = '';
    var chk_sidi = false;
    var tgl_sidi = '';
    var tgl_menikah = '';

    nama = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(0)").text();
    jk = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(1)").text();
    gol_darah = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(2)").text();

    var temp = '';

    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(3)").text()) {
      temp = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(3)").text();
      tgl_lahir = set_tanggal_database(temp);
    }

    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(4)").text()) {
      chk_baptis = true;
    }

    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(5)").text()) {
      temp = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(5)").text();
      tgl_baptis = set_tanggal_database(temp);
    }

    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(6)").text()) {
      chk_sidi = true;
    }

    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(7)").text()) {
      temp = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(7)").text();
      tgl_sidi = set_tanggal_database(temp);
    }

    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(8)").text()) {
      temp = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(8)").text();
      tgl_menikah = set_tanggal_database(temp);
    }

    var posisi = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(10)").text();
    var pendidikan_terakhir = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(11)").text();
    var pekerjaan = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(12)").text();

    daftar.push({"nama": nama, "jk": jk, "gol_darah": gol_darah,"tgl_lahir": tgl_lahir, "chk_baptis": chk_baptis, "tgl_baptis": tgl_baptis,  "chk_sidi": chk_sidi, "tgl_sidi": tgl_sidi, "tgl_menikah": tgl_menikah, "posisi": posisi, "pendidikan_terakhir": pendidikan_terakhir, "pekerjaan": pekerjaan});

    
  }

  console.log(daftar);
  var jawab = ajax_post(base_url+"jemaat/add", { "nik": nik, "mobile_phone": mobile_phone, "alamat": alamat, "sektor_id": sektor_id, "daftar": daftar });

  if (jawab.msg == "error") {
    pesan_error("Data NIK sudah ada!");
  } else {
    $("#txtNIKAkhirEdit").val("");
    $("#txtAlamat").val("");
    $("#txtNama").val("");
    $("#txtTanggalLahir").val("");
    $("#txtTanggalBaptis").val("");
    $("#tblDaftarCalonJemaat tbody").empty();
    $("#AddEditJemaat").modal("hide");

    loadDataJemaat(sektor_id)
  }


});


$(document).on("change", "#chkBaptisEdit", function() {

    if ($("#chkBaptisEdit").is(':checked')) {
        $("#txtTanggalBaptisEdit").prop("disabled", false);
    } else {
        $("#txtTanggalBaptisEdit").prop("disabled", true);
    }
});

$(document).on("change", "#chkSidiEdit", function() {

    if ($("#chkSidiEdit").is(':checked')) {
        $("#txtTanggalSidiEdit").prop("disabled", false);
    } else {
        $("#txtTanggalSidiEdit").prop("disabled", true);
    }
});

$(document).on("click", ".btn-tambah-calon-anggota-edit", function() {

  let base_url = $("#base_url").val()+"api/intern/";

  if ($("#txtNamaEdit").val()=='') {
    alert("Masukkan nama calon anggota!");
    $("#txtNamaEdit").focus();
    return false;
  }

  if ($("#txtTanggalLahirEdit").val()=='') {
    alert("Masukkan tamggal lahir calon anggota!");
    $("#txtTanggalLahirEdit").focus();
    return false;
  }

  var nama = $("#txtNamaEdit").val();
  var jk = $("#slcJenisKelaminEdit").val();
  var gol_darah = $("#slcGolonganDarahEdit").val();
  var tgl_lahir = $("#txtTanggalLahirEdit").val();
  var chk_baptis = $("#chkBaptisEdit").prop("checked");
  var tgl_baptis = $("#txtTanggalBaptisEdit").val();
  var chk_sidi = $("#chkSidiEdit").prop("checked");
  var tgl_sidi = $("#txtTanggalSidiEdit").val();
  var tgl_menikah = $("#txtTanggalMenikahEdit").val();
  var posisi_keluarga = $("#slcPosisiEdit").val();
  var pendidikan_terakhir = $("#slcPendidikanTerakhirEdit").val();
  var pekerjaan = $("#slcPekerjaanEdit").val();
  var jemaat_id = $("#txtJemaatIDEdit").val();

  // console.log(gol_darah);

  var jawab = ajax_post(base_url+"jemaat/anggota/add", {"nama": nama, "jk": jk, "golongan_darah": gol_darah, "tgl_lahir": tgl_lahir, "chk_baptis": chk_baptis, "tgl_baptis": tgl_baptis, "chk_sidi": chk_sidi, "tgl_sidi": tgl_sidi, "tgl_menikah": tgl_menikah, "posisi": posisi_keluarga, "pendidikan_terakhir": pendidikan_terakhir, "pekerjaan": pekerjaan, "jemaat_id": jemaat_id} );

  if (jawab["msg"]=="ok") {

    loadDataAnggotaKeluarga(jemaat_id);
    $("#txtNamaEdit").val("");
    $("#txtTanggalLahirEdit").val("");
    $("chkBaptisEdit").prop("checked", false);
    $("#txtTanggalBaptisEdit").val("");
    $("chkSidiEdit").prop("checked", false);
    $("#txtTanggalSidiEdit").val("");
    $("#txtTanggalMenikahEdit").val("");

  } else {

    alert("Anggota keluarga tidak berhasil ditambahkan!");
  
  }

});




$(document).on("click", "#btnEditJemaatNIK", function() {

  let base_url = $("#base_url").val()+"api/intern/";

  if ($("#txtNIKAwalEdit").val()=='') {
    alert("Masukkan nomor NIK Awal. Pilih Sektor!");
    $("#txtNIKAwalEdit").focus();
    return false;
  }

  if ($("#txtNIKAkhirEdit").val()=='') {
    alert("Masukkan nomor NIK Akhir.");
    $("#txtNIKAkhirEdit").focus();
    return false;
  }

  if ($("#txtAlamatEdit").val()=='') {
    alert("Masukkan alamat!");
    $("#txtAlamatEdit").focus();
    return false;
  }

  if ($("#txtMobilePhoneEdit").val()=='') {
    alert("Masukkan mobile phone!");
    $("#txtMobilePhoneEdit").focus();
    return false;
  }


  var NIK = $("#txtNIKAwalEdit").val() + "-" + $("#txtNIKAkhirEdit").val();
  var alamat = $("#txtAlamatEdit").val();
  var mobile_phone = $("#txtMobilePhoneEdit").val();
  var jemaat_id = $("#txtJemaatEdit").val();

  var jawab = ajax_post(base_url+"jemaat/nik/change", { "NIK": NIK, "mobile_phone": mobile_phone, "alamat": alamat, "jemaat_id": jemaat_id });
  
  if (jawab.msg=="ok") {
    $("#txtNIKAkhirEdit").val("");
    $("#txtAlamatEdit").val("");
    $("#txtNamaEdit").val("");
    $("#txtMobilePhoneEdit").val("");
    $("#editJemaatNIK").modal("hide");
    
    var sektor_id = $("#slcSektor").val();
    loadDataJemaat(sektor_id);  

  }

});

$(document).on("click", ".btn-hapus-calon", function () {
  $(this).parent().parent().remove();
});

$(document).on("click", ".btn-hapus-jemaat", function () {
  
  var base_url = $("#base_url").val()+"api/intern/";
  var jemaat_id = $(this).parent().parent().parent().attr("id");
  var sektor_id = $("#slcSektor").val();
  
  const ask = confirm("Hapus data jemaat ini?"); 
  if (ask) {
    var jawab = ajax_post(base_url+"jemaat/del", { "jemaat_id": jemaat_id });
    if (jawab['msg']=='ok') {
      $(this).parent().parent().parent().remove();
      loadDataJemaat(sektor_id);
    }

  }

});


$(document).on("click", ".btn-wafat-jemaat", function () {
  
  var anggotajemaat_id = $(this).parent().parent().attr("id");
  var jemaat_id = $("#txtJemaatIDEdit").val();
  var sektor_id = $("#slcSektor").val();

  console.log(anggotajemaat_id);
  let tgl_wafat = prompt("Masukkan tanggal wafat dari anggota keluarga ini dengan format 'dd-mm-yyyy'");
  
  if (tgl_wafat) {
    var jawab = ajax_post("jemaat/anggota/wafat", { "anggotajemaat_id": anggotajemaat_id, "tgl_wafat": tgl_wafat });
    if (jawab['msg']=='ok') {
      loadDataAnggotaKeluarga(jemaat_id, "edit");
      loadDataJemaat(sektor_id);

    }

  }


});



$(document).on("click", ".btn-hapus-anggota", function () {

  let base_url = $("#base_url").val()+"api/intern/";

  var anggotajemaat_id = $(this).parent().parent().attr("id");
  console.log(anggotajemaat_id);
  var jemaat_id = $("#txtJemaatIDEdit").val();
  var sektor_id = $("#slcSektor").val();

  const ask = confirm("Hapus data anggota keluarga ini?"); 
  if (ask) {
    var jawab = ajax_post(base_url+"jemaat/anggota/del", { "anggotajemaat_id": anggotajemaat_id });
    if (jawab['msg']=='ok') {
      loadDataAnggotaKeluarga(jemaat_id, "edit");
      loadDataJemaat(sektor_id);

    }

  }

});

$(document).on("click", ".btn-simpan-perubahan-anggota", function () {

  let base_url = $("#base_url").val()+"api/intern/";

  var anggotajemaat_id = $(this).parent().parent().attr("id");
  var jk = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().find("option:selected").val();
  var gol_darah = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().find("option:selected").val();
  var tgl_lahir = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().find("input").val();
  var chk_baptis = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().find("input").prop("checked");
  var tgl_baptis = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().find("input").val();
  var chk_sidi = $(this).parent().prev().prev().prev().prev().prev().prev().prev().find("input").prop("checked");
  var tgl_sidi = $(this).parent().prev().prev().prev().prev().prev().prev().find("input").val();
  var tgl_menikah = $(this).parent().prev().prev().prev().prev().prev().find("input").val();
  var tgl_wafat = $(this).parent().prev().prev().prev().prev().find("input").val();
  var posisi = $(this).parent().prev().prev().prev().find("option:selected").val();
  var pendidikan_terakhir = $(this).parent().prev().prev().find("option:selected").val();
  var pekerjaan = $(this).parent().prev().find("option:selected").val();

  var data = {
              "jk": jk, 
              "gol_darah": gol_darah, 
              "tgl_lahir": tgl_lahir, 
              "chk_baptis": chk_baptis,
              "tgl_baptis": tgl_baptis, 
              "chk_sidi": chk_sidi,
              "tgl_sidi": tgl_sidi, 
              "tgl_menikah": tgl_menikah, 
              "tgl_wafat": tgl_wafat, 
              "posisi": posisi,
              "pendidikan_terakhir": pendidikan_terakhir,
              "pekerjaan": pekerjaan,
              "anggotajemaat_id": anggotajemaat_id
  };

  console.log(data);

  const ask = confirm("Simpan perubahan data anggota keluarga ini?"); 
  
  if (ask) {
    var jawab = ajax_post(base_url+"jemaat/anggota/savechange", { "anggotajemaat_id": anggotajemaat_id, "data": data });
    if (jawab['msg']=='ok') {
      alert("Perubahan data anggota keluarga telah disimpan!");
    }
  }

});

$(document).on("click", "#btnEditJemaatAnggota", function() {
  $("#editJemaatAnggota").modal("hide");
});



$(document).on("click", ".nick", function() {
  
  var jemaat_id = $(this).parent().parent().attr("id");
  loadDataAnggotaKeluarga(jemaat_id, "show");

});

function loadDataSektor() {

  let base_url = $("#base_url").val()+"api/intern/";

  var data = ajax_get(base_url+"sektor/all", "");

  var opt = "<option value=''>-</option>";
  if (data['data'].length>0) {
    for (var i=0; i<data['data'].length; i++) {
      opt = opt + "<option value='"+data['data'][i]['sektor_id']+"'>"+data['data'][i]['no_sektor']+"|"+data['data'][i]['nama_sektor']+"</option>";
    }
    $("#slcSektor").empty();
    $("#slcSektor").html(opt);
  }

}

function loadDataSektorForm() {

  let base_url = $("#base_url").val()+"api/intern/";

  var data = ajax_get(base_url+"sektor/all", "");

  var opt = "";
  for (var i=0; i<data['data'].length; i++) {
    opt = opt + "<option value='"+data['data'][i]['sektor_id']+"'>"+data['data'][i]['no_sektor']+"|"+data['data'][i]['nama_sektor']+"</option>";
  }
  $("#slcSektorForm").empty();
  $("#slcSektorForm").html(opt);
}

function loadDataJemaat(sektor_id) {

  let base_url = $("#base_url").val()+"api/intern/";

  var temp = ajax_get(base_url+"jemaat/sektor", {"sektor_id": sektor_id});
  var jumlah = 0;

  $("#tblJemaat tbody").html("");

  if (temp['msg']=='error') {
    jumlah = 0;
  } else {

    var jumlah = temp['data'].length;

    var isi = '';

    var total_orang = 0;

    for (var i=0; i<jumlah; i++) {
      let nama_keluarga = temp['data'][i]['keluarga'][0]['pasangan'];
      let jumlah = temp['data'][i]['keluarga'][0]['jumlah'];
      isi = isi + "<tr id='"+temp['data'][i]['jemaat_id']+"'><td><h5 class='nick'>"+temp['data'][i]['nik']+"</h5></td><td>"+temp['data'][i]['mobile_phone']+"</td><td>"+nama_keluarga+"</td><td>"+temp['data'][i]['alamat']+"</td><td>"+jumlah+"</td><td>"+temp['data'][i]['status_keanggotaan']+"</td><td>";
      isi = isi + "<div class='dropdown'>";
      isi = isi + "<button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>";
      isi = isi + "Edit</button>";
      isi = isi + "<ul class='dropdown-menu ul-edit' aria-labelledby='dropdownMenuButton1'>";
      isi = isi + " <li><a class='dropdown-item' href='#'>Data Umum</a></li>";
      isi = isi + " <li><a class='dropdown-item' href='#'>Daftar Keluarga</a></li>";
      isi = isi + "</ul>";
      isi = isi + "&nbsp;<button class='btn btn-danger btn-hapus-jemaat'>Hapus</button></ul>";
      isi = isi + "</div></td></tr>";
      total_orang = total_orang + parseInt(jumlah);
    }

    isi = isi + "<tr><td colspan='4'>T o t a l</td><td>"+total_orang+"<td colspan='3'></td></tr>";
    $("#tblJemaat tbody").html(isi);

  }
  $("#pJumlahJemaat").text(jumlah + " KK");


}

function loadDataUmum(jemaat_id) {

    let base_url = $("#base_url").val()+"api/intern/";

    var jawab = ajax_get(base_url+"jemaat/nik", { "jemaat_id": jemaat_id });
    

    if (jawab["msg"]=="ok") {

      var data_jemaat = jawab['data'];

      var nik_lengkap = data_jemaat['nik'];
      var alamat = data_jemaat['alamat'];
      var mobile_phone = data_jemaat['mobile_phone'];
      var jemaat_id = data_jemaat['jemaat_id'];

      var nik = nik_lengkap.split("-");
      $("#txtNIKAwalEdit").val(nik[0]);
      $("#txtNIKAkhirEdit").val(nik[1]);
      $("#txtAlamatEdit").val(alamat);
      $("#txtMobilePhoneEdit").val(mobile_phone);
      $("#txtJemaatEdit").val(jemaat_id);
      $("#editJemaatNIK").modal("show");

    }

}

function check_kebaktian() {

    let base_url = $("#base_url").val()+"api/intern/";

    var jawab = ajax_get(base_url+"kebaktian/checkminggu", {});

    console.log(jawab.data);


    if (jawab.data.data==false) {

      let tanggal = set_tanggal(jawab.data.tanggal);

      let pesan = '';

      $("#modalKosongKebaktian").modal("show");

      pesan = "<p><h3>Data Kebaktian pada tanggal : <span class='badge bg-warning text-dark'>"+tanggal+"</span> masih kosong!</h3></p>";
      pesan = pesan + "<p>Mohon Diisi melalui menu Kebaktian</p>";
      
      $("#pesanKebaktian").html(pesan);

    }

}

function loadDataAnggotaKeluarga(jemaat_id, jenis='') {

    let base_url = $("#base_url").val()+"api/intern/";

    var jawab = ajax_get(base_url+"jemaat/anggota", { "jemaat_id": jemaat_id });
    
    // console.log(jenis);

    if (jenis!=="show") {
        if (jawab["msg"]=="ok") {

          var data = jawab['data'];
          
          console.log(data);
          var isi = "";

          for (var i=0; i<data.length; i++) {
            var tgl_lahir = "...";
            var chk_baptis = "";
            var tgl_baptis = "...";
            var chk_sidi = "";
            var tgl_sidi = "...";
            var tgl_menikah = "...";
            var tgl_wafat = "...";

            if (data[i]['tgl_lahir']) {
              tgl_lahir = set_tanggal(data[i]['tgl_lahir']);
            }

            if (data[i]['chk_baptis']==true) {
              chk_baptis = "<input type='checkbox' name='chk_baptis' checked>";
            } else {
              chk_baptis = "<input type='checkbox' name='chk_baptis'>";
            }

            if (data[i]['tgl_baptis']) {
              tgl_baptis = set_tanggal(data[i]['tgl_baptis']);
            }

            if (data[i]['chk_sidi']==true) {
              chk_sidi = "<input type='checkbox' name='chk_sidi' checked>";
            } else {
              chk_sidi = "<input type='checkbox' name='chk_sidi'>";
            }

            if (data[i]['tgl_sidi']) {
              tgl_sidi = set_tanggal(data[i]['tgl_sidi']);
            }
            
            if (data[i]['tgl_menikah']) {
              tgl_menikah = set_tanggal(data[i]['tgl_menikah']);
            }

            if (data[i]['tgl_wafat']) {
              tgl_wafat = set_tanggal(data[i]['tgl_wafat']);
            }

            var slcGolonganDarah ='';
            if (data[i]['golongan_darah'] == 'None') {
              slcGolonganDarah = "<select style='width:70px;'><option value='None' selected>None</option><option value='A'>A</option><option value='B'>B</option><option value='AB'>AB</option><option value='O'>O</option></select>";
            }
            if (data[i]['golongan_darah'] == 'A') {
              slcGolonganDarah = "<select style='width:70px;'><option value=''></option><option value='A' selected>A</option><option value='B'>B</option><option value='AB'>AB</option><option value='O'>O</option></select>";
            }
            if (data[i]['golongan_darah'] == 'B') {
              slcGolonganDarah = "<select style='width:70px;'><option value=''></option><option value='A'>A</option><option value='B' selected>B</option><option value='AB'>AB</option><option value='O'>O</option></select>";
            }
            if (data[i]['golongan_darah'] == 'AB') {
              slcGolonganDarah = "<select style='width:70px;'><option value=''></option><option value='A'>A</option><option value='B'>B</option><option value='AB' selected>AB</option><option value='O'>O</option></select>";
            }
            if (data[i]['golongan_darah'] == 'O') {
              slcGolonganDarah = "<select style='width:70px;'><option value=''></option><option value='A'>A</option><option value='B'>B</option><option value='AB'>AB</option><option value='O' selected>O</option></select>";
            }

            var slcPosisi ='';
            if (data[i]['posisi'] == 'Suami') {
              slcPosisi = "<select style='width:70px;'><option value='Suami' selected>Suami</option><option value='Istri'>Istri</option><option value='Anak'>Anak</option><option value='AKL'>Anggota Keluarga Lain</option><option value='Mandiri'>Mandiri</option></select>";
            }
            if (data[i]['posisi'] == 'Istri') {
              slcPosisi = "<select style='width:70px;'><option value='Suami'>Suami</option><option value='Istri' selected>Istri</option><option value='Anak'>Anak</option><option value='AKL'>Anggota Keluarga Lain</option><option value='Mandiri'>Mandiri</option></select>";
            }
            if (data[i]['posisi'] == 'Anak') {
              slcPosisi = "<select style='width:70px;'><option value='Suami'>Suami</option><option value='Istri'>Istri</option><option value='Anak' selected>Anak</option><option value='AKL'>Anggota Keluarga Lain</option><option value='Mandiri'>Mandiri</option></select>";
            }
            if (data[i]['posisi'] == 'AKL') {
              slcPosisi = "<select style='width:70px;'><option value='Suami'>Suami</option><option value='Istri'>Istri</option><option value='Anak'>Anak</option><option value='AKL' selected>Anggota Keluarga Lain</option><option value='Mandiri'>Mandiri</option></select>";
            }
            if (data[i]['posisi'] == 'Mandiri') {
              slcPosisi = "<select style='width:70px;'><option value='Suami'>Suami</option><option value='Istri'>Istri</option><option value='Anak'>Anak</option><option value='AKL'>Anggota Keluarga Lain</option><option value='Mandiri' selected>Mandiri</option></select>";
            }

            let slcPendidikanTerakhir = '';
            if (data[i]['pendidikan_terakhir'] == 'SD') {
              slcPendidikanTerakhir = "<select style='width:70px;'><option value='SD' selected>SD</option><option value='SMP'>SMP</option><option value='SMA-SMK'>SMA-SMK</option><option value='D3'>D3</option><option value='S1'>S1</option><option value='S2'>S2</option><option value='S3'>S3</option><option value='None'>None</option></select>";
            }
            if (data[i]['pendidikan_terakhir'] == 'SMP') {
              slcPendidikanTerakhir = "<select style='width:70px;'><option value='SD'>SD</option><option value='SMP' selected>SMP</option><option value='SMA-SMK'>SMA-SMK</option><option value='D3'>D3</option><option value='S1'>S1</option><option value='S2'>S2</option><option value='S3'>S3</option><option value='None'>None</option></select>";
            }
            if (data[i]['pendidikan_terakhir'] == 'SMA-SMK') {
              slcPendidikanTerakhir = "<select style='width:70px;'><option value='SD'>SD</option><option value='SMP'>SMP</option><option value='SMA-SMK' selected>SMA-SMK</option><option value='D3'>D3</option><option value='S1'>S1</option><option value='S2'>S2</option><option value='S3'>S3</option><option value='None'>None</option></select>";
            }
            if (data[i]['pendidikan_terakhir'] == 'D3') {
              slcPendidikanTerakhir = "<select style='width:70px;'><option value='SD'>SD</option><option value='SMP'>SMP</option><option value='SMA-SMK'>SMA-SMK</option><option value='D3' selected>D3</option><option value='S1'>S1</option><option value='S2'>S2</option><option value='S3'>S3</option><option value='None'>None</option></select>";
            }
            if (data[i]['pendidikan_terakhir'] == 'S1') {
              slcPendidikanTerakhir = "<select style='width:70px;'><option value='SD'>SD</option><option value='SMP'>SMP</option><option value='SMA-SMK'>SMA-SMK</option><option value='D3'>D3</option><option value='S1' selected>S1</option><option value='S2'>S2</option><option value='S3'>S3</option><option value='None'>None</option></select>";
            }
            if (data[i]['pendidikan_terakhir'] == 'S2') {
              slcPendidikanTerakhir = "<select style='width:70px;'><option value='SD'>SD</option><option value='SMP'>SMP</option><option value='SMA-SMK'>SMA-SMK</option><option value='D3'>D3</option><option value='S1'>S1</option><option value='S2' selected>S2</option><option value='S3'>S3</option><option value='None'>None</option></select>";
            }
            if (data[i]['pendidikan_terakhir'] == 'S3') {
              slcPendidikanTerakhir = "<select style='width:70px;'><option value='SD'>SD</option><option value='SMP'>SMP</option><option value='SMA-SMK'>SMA-SMK</option><option value='D3'>D3</option><option value='S1'>S1</option><option value='S2'>S2</option><option value='S3' selected>S3</option><option value='None'>None</option></select>";
            }
            if (data[i]['pendidikan_terakhir'] == 'None') {
              slcPendidikanTerakhir = "<select style='width:70px;'><option value='SD'>SD</option><option value='SMP'>SMP</option><option value='SMA-SMK'>SMA-SMK</option><option value='D3'>D3</option><option value='S1'>S1</option><option value='S2'>S2</option><option value='S3'>S3</option><option value='None' selected>None</option></select>";
            }

            let slcPekerjaan = '';
            if (data[i]['pekerjaan'] == 'None') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None' selected>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'ASN') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN' selected>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'TNI-Polri') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri' selected>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'Karyawan-Swasta') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta' selected>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'Pedagang') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang' selected>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'Wiraswasta') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta' selected>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'Dokter') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter' selected>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'Petani') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani' selected>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'Guru Injil') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil' selected>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'Pendeta') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta' selected>Pendeta</option><option value='Buruh Harian Lepas'>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }
            if (data[i]['pekerjaan'] == 'Buruh Harian Lepas') {
              slcPekerjaan = "<select style='width:70px;'><option value='ASN'>ASN</option><option value='TNI-Polri'>TNI-Polri</option><option value='Karyawan-Swasta'>Karyawan Swasta</option><option value='Pedagang'>Pedagang</option><option value='Wiraswasta'>Wiraswasta</option><option value='Dokter'>Dokter</option><option value='Petani'>Petani</option><option value='Guru Injil'>Guru Injil</option><option value='Pendeta'>Pendeta</option><option value='Buruh Harian Lepas' selected>Buruh Harian Lepas</option><option value='None'>None</option></select>";
            }

            if (data[i]['jk']==undefined) {
              isi = isi + "<tr id='"+data[i]['anggotajemaat_id']+"'><td>"+data[i]['nama']+"</td><td><select><option></option><option value='L'>L</option><option value='P'>P</option></select></td><td>"+slcGolonganDarah+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_lahir']+"'></td><td>"+chk_baptis+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_baptis']+"'></td><td>"+chk_sidi+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_sidi']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_menikah']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_wafat']+"'></td><td>"+slcPosisi+"</td><td>"+slcPendidikanTerakhir+"</td><td>"+slcPekerjaan+"</td><td>";
            } else {
              if (data[i]['jk']=='L') {
                isi = isi + "<tr id='"+data[i]['anggotajemaat_id']+"'><td>"+data[i]['nama']+"</td><td><select><option value='L' selected>L</option><option value='P'>P</option></selec></td><td>"+slcGolonganDarah+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_lahir']+"'></td><td>"+chk_baptis+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_baptis']+"'></td><td>"+chk_sidi+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_sidi']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_menikah']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_wafat']+"'></td><td>"+slcPosisi+"</td><td>"+slcPendidikanTerakhir+"</td><td>"+slcPekerjaan+"</td><td>";
              } else {
                isi = isi + "<tr id='"+data[i]['anggotajemaat_id']+"'><td>"+data[i]['nama']+"</td><td><select><option value='L'>L</option><option value='P' selected>P</option></selec></td><td>"+slcGolonganDarah+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_lahir']+"'></td><td>"+chk_baptis+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_baptis']+"'></td><td>"+chk_sidi+"</td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_sidi']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_menikah']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_wafat']+"'></td><td>"+slcPosisi+"</td><td>"+slcPendidikanTerakhir+"</td><td>"+slcPekerjaan+"</td><td>";
              }
            }
            if (data[i]['tgl_wafat']===null || data[i]['tgl_wafat']==='') {
              isi = isi + "&nbsp;<button class='btn btn-info btn-simpan-perubahan-anggota'>Simpan</button>&nbsp;<button class='btn btn-danger btn-hapus-anggota'>Hapus</button></ul>";
            } else {
              isi = isi + "[Meninggal Dunia]";
            }
            isi = isi + "</div></td></tr>";
          }

          $("#txtJemaatIDEdit").val(jemaat_id);
          $("#tblDaftarCalonJemaatEdit thead tr").find("th:eq(7)").show();
          $("#tblDaftarCalonJemaatEdit tbody").empty();
          $("#tblDaftarCalonJemaatEdit tbody").html(isi);
          $("#formEditJemaat").show();
          $("#editJemaatAnggota").modal("show");
        }
    
    } else {

        if (jawab["msg"]=="ok") {

          $("#titleShow").text("Data Anggota Keluarga Jemaat")
          $("#btnEditDataKeluarga").hide();
          $("#formEditJemaat").hide();

          var data = jawab['data'];
          console.log(data);
          var isi = "";

          for (var i=0; i<data.length; i++) {
            var tgl_lahir = "...";
            var chk_baptis = false;
            var tgl_baptis = "...";
            var chk_sidi = false;
            var tgl_sidi = "...";
            var tgl_menikah = "...";
            var tgl_wafat = "...";


            if (data[i]['tgl_lahir']) {
              tgl_lahir = set_tanggal(data[i]['tgl_lahir']);
            }

            if (data[i]['chk_baptis']==true) {
              chk_baptis = "&#10004;";
            } else {
              chk_baptis = "";
            }

            if (data[i]['tgl_baptis']!=='0000-00-00' && data[i]['tgl_baptis']!=='') {
              tgl_baptis = set_tanggal(data[i]['tgl_baptis']);
            }

            if (data[i]['chk_sidi']==true) {
              chk_sidi = "&#10004;";
            } else {
              chk_sidi = "";
            }

            if (data[i]['tgl_sidi']!=='0000-00-00' && data[i]['tgl_sidi']!=='') {
              tgl_sidi = set_tanggal(data[i]['tgl_sidi']);
            }
            
            if (data[i]['tgl_menikah']!=='0000-00-00' && data[i]['tgl_menikah']!=='') {
              tgl_menikah = set_tanggal(data[i]['tgl_menikah']);
            }

            if (data[i]['tgl_wafat']) {
              tgl_wafat = set_tanggal(data[i]['tgl_wafat']);
            }

            isi = isi + "<tr id='"+data[i]['anggotajemaat_id']+"'><td>"+data[i]['nama']+"</td><td>"+data[i]['jk']+"</td><td>"+data[i]['golongan_darah']+"</td><td>"+tgl_lahir+"</td><td>"+chk_baptis+"</td><td>"+tgl_baptis+"</td><td>"+chk_sidi+"</td><td>"+tgl_sidi+"</td><td>"+tgl_menikah+"</td><td>"+tgl_wafat+"</td><td>"+data[i]['posisi']+"</td><td>"+data[i]['pendidikan_terakhir']+"</td><td>"+data[i]['pekerjaan']+"</td><td>";
            if (data[i]['tgl_wafat']===null || data[i]['tgl_wafat']==='' ) {
              isi = isi + "</div></td></tr>";
            } else {
              isi = isi + "[Meninggal Dunia]</div>";
            }
          }

          $("#txtJemaatIDEdit").val(jemaat_id);
          $("#tblDaftarCalonJemaatEdit tbody").html(isi);
          // $("#tblDaftarCalonJemaatEdit thead tr th:eq(8)").text("Posisi");
          $("#editJemaatAnggota").modal("show");

          $("#titleShow").text("Data Anggota Keluarga Jemaat")
          $("#btnEditDataKeluarga").hide();
          $("#formEditJemaat").hide();
          $("#tblDaftarCalonJemaatEdit thead tr").find("th:eq(13)").hide();


        }

    }

}



