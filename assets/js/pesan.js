
export function pesan_error(pesan) {

    Swal.fire({
        icon: "error",
        title: "Input error",
        text: pesan
    })


}

export function pesan_sukses(pesan) {

    Swal.fire({
        title: pesan,
        icon: "success",
        draggable: true
    });    

}

export function pesan_tanya(pesan) {

    Swal.fire({
        title: pesan,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
        });
    });

}
