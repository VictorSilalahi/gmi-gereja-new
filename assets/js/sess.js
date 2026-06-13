import { ajax_get } from "./ajx.js";

export function check_session() {
    let temp = ajax_get("/");
    if (temp==false) {
        window.location.replace("/");
    }

}