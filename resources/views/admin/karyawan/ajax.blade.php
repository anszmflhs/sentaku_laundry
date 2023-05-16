<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('karyawan.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'photo',
                    render: function(data, type) {
                        const regex = /^(http|https):\/\//g
                        let src = '';

                        if (data == null) {
                            src =
                                'http://127.0.0.1:8000/images/no-image.jpg';
                        } else {

                            if (data.match(regex)) {

                                src = data;
                            } else {
                                const host = 'http://127.0.0.1:8000/uploads/users/';
                                src = host + data;
                            }
                        }

                        if (type === 'display') {
                            return '<img src="' + src + '"' + 'width="50" height="50">';
                        }
                        return src;
                    }
                },
                {
                    data: 'name',

                },
                {
                    data: 'contact',
                },
                {
                    data: 'servicemanage.title',
                },
                {
                    data: 'hire_date'
                },
                {
                    data: 'gender',
                    render: function(data, type) {
                        let jenisKelamin = '';
                        if (data === 'L') {
                            jenisKelamin = 'L';
                        } else {
                            jenisKelamin = 'P';
                        }
                        if (type === 'display') {
                            return '<span>' + jenisKelamin + '</span>';
                        }
                        return jenisKelamin;
                    }
                },
                {
                    data: 'address'
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
        location.replace('/admin/karyawan/' + id)
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
                    url: "/admin/karyawan/" + id,
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
