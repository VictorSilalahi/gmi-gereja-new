import { ajax_get, ajax_post, check_token } from "../ajx.js";
// import { createPDF } from "../report.js";

let base_url = $("#base_url").val()+"api/intern/";

$(document).ready(function () {

    check_token();

    var jawab = ajax_get(base_url+"report/statistik/getdata", {});

    console.log(jawab.data);

    if (jawab.msg=='ok') {
        // jumlah

        // grafik utk tipe keanggotaan
        const ctx_tipe_keanggotaan = document.getElementById('TipeKeanggotaan');
        const data_tipe_keanggotaan = jawab.data[0]['anggota'];
        const data_anggota_jemaat = jawab.data[0]['kk'];

        let KK = data_tipe_keanggotaan['jumlah anggota jemaat kk aktif'] + data_tipe_keanggotaan['jumlah anggota jemaat kk tidak aktif'];
        let Jiwa = data_anggota_jemaat['jumlah kk jemaat aktif'] + data_anggota_jemaat['jumlah kk jemaat tidak aktif'];

        $("#bgKK").text(Jiwa);
        $("#bgJiwa").text(KK);
        
        new Chart(ctx_tipe_keanggotaan, {
                type: 'pie',
                data: {
                labels: ['Aktif', 'Tidak Aktif'],
                datasets: [{
                    label: '#',
                    data: [data_tipe_keanggotaan['jumlah anggota jemaat kk aktif'], data_tipe_keanggotaan['jumlah anggota jemaat kk tidak aktif']],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
        });

        // grafik utk kelompok umur
        const ctx_kelompok_umur = document.getElementById('KelompokUmur');
        const data_kelompok_umur = jawab.data[0]['kelompok umur'];
        new Chart(ctx_kelompok_umur, {
                type: 'pie',
                data: {
                labels: ['Anak-anak', 'Remaja', 'Pemuda', 'Dewasa', 'Lansia'],
                datasets: [{
                    label: '#',
                    data: [data_kelompok_umur['anak-anak'], data_kelompok_umur['remaja'], data_kelompok_umur['pemuda'], data_kelompok_umur['dewasa'], data_kelompok_umur['lansia']],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
        });

        // grafik utk sifat keanggotaan
        const ctx_sifat_keanggotaan = document.getElementById('SifatKeanggotaan');
        const data_sifat_keanggotaan = jawab.data[0]['sifat keanggotaan'];
        new Chart(ctx_sifat_keanggotaan, {
                type: 'pie',
                data: {
                labels: ['Penuh', 'Persiapan'],
                datasets: [{
                    label: '#',
                    data: [data_sifat_keanggotaan['penuh'], data_sifat_keanggotaan['persiapan']],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
            }
        });

        // grafik jemaat per sektor
        const ctx_per_sektor = document.getElementById('JemaatPerSektor');
        const data_per_sektor = jawab.data[0]['data_sektor'];
        var kolom_graph = [];
        var nilai = [];
        for (var i=0; i<data_per_sektor.length; i++) {
            kolom_graph.push(data_per_sektor[i]['sektor']);
            nilai.push(data_per_sektor[i]['jumlah']);
        }
        new Chart(ctx_per_sektor, {
                type: 'pie',
                data: {
                labels: kolom_graph,
                datasets: [{
                    label: '#',
                    data: nilai,
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
        });


    }

});


