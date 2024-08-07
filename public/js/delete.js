$(".delete-confirm").click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya, Hapus",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });