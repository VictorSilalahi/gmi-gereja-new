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


  var nama = $("#txtNama").val();
  var jk = $("#slcJenisKelamin").val();
  var tgl_lahir = '';
  var tgl_baptis = '';
  var tgl_sidi = '';
  var tgl_menikah = '';

  if ($("#txtTanggalLahir").val()) {
    tgl_lahir = set_tanggal_indo($("#txtTanggalLahir").val());
  }
  if ($("#txtTanggalBaptis").val()) {
    tgl_baptis = set_tanggal_indo($("#txtTanggalBaptis").val());
  }
  if ($("#txtTanggalSidi").val()) {
    tgl_sidi = set_tanggal_indo($("#txtTanggalSidi").val());
  }
  if ($("#txtTanggalMenikah").val()) {
    tgl_menikah = set_tanggal_indo($("#txtTanggalMenikah").val());
  }

  var posisi_keluarga = $("#slcPosisi").val();

  var row_to_add = "<tr><td>"+nama+"</td><td>"+jk+"</td><td>"+tgl_lahir+"</td><td>"+tgl_baptis+"</td><td>"+tgl_sidi+"</td><td>"+tgl_menikah+"</td><td>"+posisi_keluarga+"</td><td><button class='btn btn-danger btn-hapus-calon'>Hapus</button></td></tr>";
  $("#tblDaftarCalonJemaat tbody").append(row_to_add);
  $("#txtNama").val("");
  $("#txtTanggalLahir").val("");
  $("#txtTanggalBaptis").val("");
  $("#txtTanggalSidi").val("");
  $("#txtTanggalMenikah").val("");
  $("#txtNama").focus();

});

$(document).on("click", "#btnOKJemaat", function () {
  
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

  var NIK = $("#txtNIKAwal").val() + "-" + $("#txtNIKAkhir").val();
  var tgl_terdaftar = $("#txtTanggalTerdaftar").val();
  var mobile_phone = $("#txtMobilePhone").val();
  var alamat = $("#txtAlamat").val();
  var status_keanggotaan = $("#slcStatus").val();
  var sektor_id = $("#slcSektorForm").val();

  var daftar = [];
  var nama = '';
  var jk = '';
  var tgl_lahir = '';
  var tgl_baptis = '';
  var tgl_sidi = '';
  var tgl_menikah = '';

  for (var i=0; i<$("#tblDaftarCalonJemaat tbody tr").length; i++) {
    nama = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(0)").text();
    jk = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(1)").text();

    var temp = '';

    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(2)").text()) {
      temp = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(2)").text();
      tgl_lahir = set_tanggal_database(temp);
    }
    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(3)").text()) {
      temp = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(3)").text();
      tgl_baptis = set_tanggal_database(temp);
    }
    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(4)").text()) {
      temp = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(4)").text();
      tgl_sidi = set_tanggal_database(temp);
    }
    if ($("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(5)").text()) {
      temp = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(5)").text();
      tgl_menikah = set_tanggal_database(temp);
    }
    var posisi = $("#tblDaftarCalonJemaat tbody tr:eq("+i+") td:eq(6)").text();

    daftar.push({"nama": nama, "jk": jk, "tgl_lahir": tgl_lahir, "tgl_baptis": tgl_baptis, "tgl_sidi": tgl_sidi, "tgl_menikah": tgl_menikah, "posisi": posisi});

  }

  // console.log(daftar);
  var jawab = ajax_post("jemaat/add", { "NIK": NIK, "tgl_terdaftar": tgl_terdaftar, "mobile_phone": mobile_phone, "alamat": alamat, "status": status_keanggotaan, "sektor_id": sektor_id, "data": daftar });

  if (jawab.msg == "error") {
    alert("Data NIK ini sudah ada!");
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


$(document).on("click", ".btn-tambah-calon-anggota-edit", function() {

  if ($("#txtNamaEdit").val()=='') {
    alert("Masukkan nama calon anggota!");
    $("#txtNamaEdit").focus();
    return false;
  }


  var nama = $("#txtNamaEdit").val();
  var jk = $("#slcJenisKelaminEdit").val();
  var tgl_lahir = $("#txtTanggalLahirEdit").val();
  var tgl_baptis = $("#txtTanggalBaptisEdit").val();
  var tgl_sidi = $("#txtTanggalSidiEdit").val();
  var tgl_menikah = $("#txtTanggalMenikahEdit").val();
  var posisi_keluarga = $("#slcPosisiEdit").val();
  var jemaat_id = $("#txtJemaatIDEdit").val();


  var jawab = ajax_post("jemaat/anggota/add", {"nama": nama, "jk": jk, "tgl_lahir": tgl_lahir, "tgl_baptis": tgl_baptis, "tgl_sidi": tgl_sidi, "tgl_menikah": tgl_menikah, "posisi": posisi_keluarga, "jemaat_id": jemaat_id} );

  if (jawab["msg"]=="ok") {

    loadDataAnggotaKeluarga(jemaat_id);
    $("#txtNamaEdit").val("");
    $("#txtTanggalLahirEdit").val("");
    $("#txtTanggalBaptisEdit").val("");
    $("#txtTanggalSidiEdit").val("");
    $("#txtTanggalMenikahEdit").val("");

  } else {
    alert("Anggota keluarga tidak berhasil ditambahkan!");
  }

});




$(document).on("click", "#btnEditJemaatNIK", function() {

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
  var status_keanggotaan = $("#slcStatusEdit").val();
  var mobile_phone = $("#txtMobilePhoneEdit").val();
  var jemaat_id = $("#txtJemaatEdit").val();

  var jawab = ajax_post("jemaat/nik/change", { "NIK": NIK, "mobile_phone": mobile_phone, "alamat": alamat, "status_keanggotaan": status_keanggotaan, "jemaat_id": jemaat_id });
  
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
  
  var jemaat_id = $(this).parent().parent().parent().attr("id");
  var sektor_id = $("#slcSektor").val();
  
  const ask = confirm("Hapus data jemaat ini?"); 
  if (ask) {
    var jawab = ajax_post("jemaat/del", { "jemaat_id": jemaat_id });
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

  var anggotajemaat_id = $(this).parent().parent().attr("id");
  // console.log(anggotajemaat_id);
  var jemaat_id = $("#txtJemaatIDEdit").val();
  var sektor_id = $("#slcSektor").val();

  const ask = confirm("Hapus data anggota keluarga ini?"); 
  if (ask) {
    var jawab = ajax_post("jemaat/anggota/del", { "anggotajemaat_id": anggotajemaat_id });
    if (jawab['msg']=='ok') {
      loadDataAnggotaKeluarga(jemaat_id, "edit");
      loadDataJemaat(sektor_id);

    }

  }

});

$(document).on("click", ".btn-simpan-perubahan-anggota", function () {

  var anggotajemaat_id = $(this).parent().parent().attr("id");
  var jk = $(this).parent().prev().prev().prev().prev().prev().prev().prev().find("option:selected").val();
  var tgl_lahir = $(this).parent().prev().prev().prev().prev().prev().prev().find("input").val();
  var tgl_baptis = $(this).parent().prev().prev().prev().prev().prev().find("input").val();
  var tgl_sidi = $(this).parent().prev().prev().prev().prev().find("input").val();
  var tgl_menikah = $(this).parent().prev().prev().prev().find("input").val();
  var tgl_wafat = $(this).parent().prev().prev().find("input").val();
  var posisi = $(this).parent().prev().find("option:selected").val();

  var data = {"jk": jk, "tgl_lahir": tgl_lahir, "tgl_baptis": tgl_baptis, "tgl_sidi": tgl_sidi, "tgl_menikah": tgl_menikah, "tgl_wafat": tgl_wafat, "posisi": posisi};
  const ask = confirm("Simpan perubahan data anggota keluarga ini?"); 
  if (ask) {
    var jawab = ajax_post("jemaat/anggota/savechange", { "anggotajemaat_id": anggotajemaat_id, "data": data });
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
    var jawab = ajax_get("jemaat/nik", { "jemaat_id": jemaat_id });
    

    if (jawab["msg"]=="ok") {

      var data_jemaat = jawab['data'];

      var nik_lengkap = data_jemaat['nik'];
      var alamat = data_jemaat['alamat'];
      var mobile_phone = data_jemaat['mobile_phone'];
      var status_keanggotaan = data_jemaat['status_keanggotaan'];
      var jemaat_id = data_jemaat['jemaat_id'];

      var nik = nik_lengkap.split("-");
      $("#txtNIKAwalEdit").val(nik[0]);
      $("#txtNIKAkhirEdit").val(nik[1]);
      $("#txtAlamatEdit").val(alamat);
      $("#txtMobilePhoneEdit").val(mobile_phone);
      $("#slcStatusEdit").val(status_keanggotaan);
      $("#txtJemaatEdit").val(jemaat_id);
      $("#editJemaatNIK").modal("show");

    }

}

function loadDataAnggotaKeluarga(jemaat_id, jenis='') {

    var jawab = ajax_get("jemaat/anggota", { "jemaat_id": jemaat_id });
    
    if (jenis!=="show") {
        if (jawab["msg"]=="ok") {

          var data = jawab['data'];
          
          console.log(data);
          var isi = "";

          for (var i=0; i<data.length; i++) {
            var tgl_lahir = "...";
            var tgl_baptis = "...";
            var tgl_sidi = "...";
            var tgl_menikah = "...";
            var tgl_wafat = "...";

            if (data[i]['tgl_lahir']) {
              tgl_lahir = set_tanggal(data[i]['tgl_lahir']);
            }

            if (data[i]['tgl_baptis']) {
              tgl_baptis = set_tanggal(data[i]['tgl_baptis']);
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

            var slcPosisi ='';
            if (data[i]['posisi'] == '') {
              slcPosisi = "<select style='width:70px;'><option value=''></option><option value='Suami'>Suami</option><option value='Istri'>Istri</option><option value='Anak'>Anak</option><option value='AKL'>Anggota Keluarga Lain</option><option value='Mandiri'>Mandiri</option></select>";
            }
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

            if (data[i]['jk']==undefined) {
              isi = isi + "<tr id='"+data[i]['anggotajemaat_id']+"'><td>"+data[i]['nama']+"</td><td><select><option></option><option value='L'>L</option><option value='P'>P</option></selec></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_lahir']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_baptis']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_sidi']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_menikah']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_wafat']+"'></td><td>"+slcPosisi+"</td><td>";
            } else {
              if (data[i]['jk']=='L') {
                isi = isi + "<tr id='"+data[i]['anggotajemaat_id']+"'><td>"+data[i]['nama']+"</td><td><select><option value='L' selected>L</option><option value='P'>P</option></selec></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_lahir']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_baptis']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_sidi']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_menikah']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_wafat']+"'></td><td>"+slcPosisi+"</td><td>";
              } else {
                isi = isi + "<tr id='"+data[i]['anggotajemaat_id']+"'><td>"+data[i]['nama']+"</td><td><select><option value='L'>L</option><option value='P' selected>P</option></selec></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_lahir']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_baptis']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_sidi']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_menikah']+"'></td><td><input type='date' style='width:90px;' value='"+data[i]['tgl_wafat']+"'></td><td>"+slcPosisi+"</td><td>";
              }
            }
            if (data[i]['status']==false) {
              isi = isi + "[Meninggal Dunia]</ul>";
            } else {
              isi = isi + "&nbsp;<button class='btn btn-info btn-simpan-perubahan-anggota'>Simpan</button><button class='btn btn-danger btn-hapus-anggota'>Hapus</button></ul>";
            }
            isi = isi + "</div></td></tr>";
          }

          $("#txtJemaatIDEdit").val(jemaat_id);
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
          // console.log(data);
          var isi = "";

          for (var i=0; i<data.length; i++) {
            var tgl_lahir = "...";
            var tgl_baptis = "...";
            var tgl_sidi = "...";
            var tgl_menikah = "...";
            var tgl_wafat = "...";

            if (data[i]['tgl_lahir']) {
              tgl_lahir = set_tanggal(data[i]['tgl_lahir']);
            }

            if (data[i]['tgl_baptis']) {
              tgl_baptis = set_tanggal(data[i]['tgl_baptis']);
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

            isi = isi + "<tr id='"+data[i]['anggotajemaat_id']+"'><td>"+data[i]['nama']+"</td><td>"+data[i]['jk']+"</td><td>"+tgl_lahir+"</td><td>"+tgl_baptis+"</td><td>"+tgl_sidi+"</td><td>"+tgl_menikah+"</td><td>"+tgl_wafat+"</td><td>"+data[i]['posisi']+"</td><td>";
            if (data[i]['status']==false) {
              isi = isi + "[Meninggal Dunia]</ul>";
            }
            isi = isi + "</div></td></tr>";
          }

          $("#txtJemaatIDEdit").val(jemaat_id);
          $("#tblDaftarCalonJemaatEdit tbody").html(isi);
          $("#tblDaftarCalonJemaatEdit thead tr th:eq(8)").text("Posisi");
          $("#editJemaatAnggota").modal("show");

          $("#titleShow").text("Data Anggota Keluarga Jemaat")
          $("#btnEditDataKeluarga").hide();
          $("#formEditJemaat").hide();
          $("#tblDaftarCalonJemaatEdit thead tr").find("th:eq(7)").hide();


        }

    }

}



