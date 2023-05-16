<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('payment.index') }}",
            columns: [{
                    data: 'DT_RowIndex',

                },
                {
                    data: 'user.name',
                },
                {
                    data: 'servicemanage.title',
                },
                {
                    data: 'pricelist.another',

                },
                {
                    data: 'quantity',

                },
                {
                    data: 'total',

                },
                {
                    data: 'status',
                },
                {
                    data: 'action',

                    orderable: false,
                    searchable: false
                }
            ]
        });
    });



    // edit
    $("body").on("click", ".edit-button", function() {
        var id = $(this).attr("id")
        location.replace('/admin/payment/' + id)
    })

    // delete
    $("body").on("click", ".delete-button", function() {
        var id = $(this).attr("id")

        Swal.fire({
            title: 'Yakin hapus data ini?',
            // text: "You won't be able to revert",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/payment/" + id,
                    method: "DELETE",
                    success: function(response) {
                        $('#dataTable').DataTable().ajax.reload()
                        Swal.fire(
                            '',
                            response.message,
                            'success'
                        )
                    },
                    error: function(err) {
                        if (err.status == 403) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Not allowed!'
                            })
                        }
                    }
                })
            }
        })
    })
</script>
