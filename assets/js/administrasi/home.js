import { ajax_get, ajax_post } from "../ajx.js";

$(document).ready(function () {
  atur_konfigurasi_menu();
});


function atur_konfigurasi_menu() {

    var jawab = ajax_get("home/aturmenu", {});

    if (jawab.status=='ok') {

        let data = jawab.data;
        console.log(data);

        if (data[0]['jemaat']==true) {
            $("#cardJemaat").css('visibility', 'visible')
        }

        if (data[0]['keuangan']==true) {
            $("#cardKeuangan").css('visibility', 'visible')
        }

        if (data[0]['asset']==true) {
            $("#cardAsset").css('visibility', 'visible')
        }


    }

}
