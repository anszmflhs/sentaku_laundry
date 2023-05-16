<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.index') }}",
            columns: [{
                    data: 'DT_RowIndex',

                },
                {
                    data: 'user.name',
                },
                {
                    data: 'nohp',
                },
                {
                    data: 'alamat',
                },
                {
                    data: 'status',
                },

                // {
                //     data: 'employee.photo',
                //     render: function(data, type) {
                //         let src = '';
                //         if (type === 'display') {
                //             const host = 'http://127.0.0.1:9002/';
                //             if (data == null) {
                //                 const pathImage = 'assets/images/no-image.jpg';
                //                 src = host + pathImage;
                //             } else {
                //                 const dir = 'uploads/';
                //                 src = host + dir + data;
                //             }
                //             return '<img src="' + src + '"' + 'width="50" height="50">';

                //         }

                //         return src;
                //     }

                // },
                // {
                //     data: 'username'
                // },
                // {
                //     data: 'email'
                // },

                {
                    data: 'action',

                    orderable: false,
                    searchable: false
                },
            ]
        });
    });

    // Reset Form
    function resetForm() {
        $("[name='name']").val("")

    }
    // edit
    $("body").on("click", ".edit-button", function() {
        var id = $(this).attr("id")
        location.replace('/admin/customer/' + id)
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
                    url: "/admin/customer/" + id,
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
