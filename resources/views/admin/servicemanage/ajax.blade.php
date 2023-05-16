<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employee.index') }}",
            columns: [{
                    data: 'DT_RowIndex',

                },
                {
                    data: 'photo',
                    render: function(data, type) {
                        console.log(data);
                        const regex = /^(http|https):\/\//g
                        let src = '';

                        if (data == null) {
                            src =
                                'http://127.0.0.1:9002/assets/images/no-image.jpg';
                        } else {
                            const host = 'http://127.0.0.1:9002/uploads/';
                            src = host + data;
                            // if (data.match(regex)) {

                            //     src = data;
                            // } else {
                            //     const host = 'http://127.0.0.1:9002/uploads/';
                            //     src = host + data;
                            // }
                        }



                        if (type === 'display') {
                            return '<img src="' + src + '"' + 'width="50" height="50">';
                        }
                        return data;
                    }

                },
                {
                    data: 'name',
                    render: function(data, type) {
                        if (type == 'display') {
                            return '<span>' + data + '</span>';
                        }
                        return data;
                    }
                },
                {
                    data: 'job.title',
                    render: function(data, type) {

                        const arr = data.split(" ");

                        for (var i = 0; i < arr.length; i++) {
                            arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);

                        }

                        const str2 = arr.join(" ");

                        if (type == 'display') {
                            return '<span>' + str2 + '</span>';
                        }
                        return str2;
                    }

                },

                {
                    data: 'hire_date',

                },
                {
                    data: 'gender',
                    render: function(data, type) {
                        let jenisKelamin = '';
                        if (data === 'L') {
                            jenisKelamin = 'Laki-laki';
                        } else {
                            jenisKelamin = 'Perempuan';
                        }
                        if (type === 'display') {
                            return '<span>' + jenisKelamin + '</span>';
                        }
                        return jenisKelamin;
                    }

                },

                {
                    data: 'action',

                    orderable: false,
                    searchable: false
                },
            ]
        });
    });



    // edit
    $("body").on("click", ".edit-button", function() {
        var id = $(this).attr("id")
        location.replace('/admin/employee/' + id)
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
                    url: "/admin/employee/" + id,
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
