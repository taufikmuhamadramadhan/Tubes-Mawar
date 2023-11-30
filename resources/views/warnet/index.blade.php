<!-- resources/views/warnet/index.blade.php -->
@extends('layouts.base_admin.base_dashboard')

@section('script_head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="container">
        <h2>Warnet List</h2>
        <a href="{{ route('warnet.create') }}" class="btn btn-primary">Add Warnet</a>
        <form action="{{ route('warnet.exportPdf') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-warning">Export to PDF</button>
</form>

        <table class="table mt-3" id="warnet-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
    @endsection @section('script_footer')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#warnet-table').DataTable({
                    "serverSide": true,
                    "processing": true,
                    "ajax": {
                        "url": "{{ route('warnet.dataTable') }}",
                        "type": "POST",
                        "data": {
                        _token: "{{ csrf_token() }}"
                        }
                    },
                    "columns": [{
                        "data": "id_warnet",
                        "name": "id_warnet"
                    },
                    {
                        "data": "nama_warnet",
                        "name": "nama_warnet"
                    },
                    {
                        "data": "alamat",
                        "name": "alamat"
                    },
                    {
                        "data": "options",
                        "name": "options"
                    }
                ],

                });
            });

            // hapus data
            $('#warnet-table').on('click', '.hapusData', function() {
                var id = $(this).data("id");
                var url = $(this).data("url");
                Swal
                    .fire({
                        title: 'Apa kamu yakin?',
                        text: "Kamu tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            // console.log();
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    "id": id,
                                    "_token": "{{csrf_token()}}"
                                },
                                success: function(response) {
                                    // console.log();
                                    Swal.fire('Terhapus!', response.msg, 'success');
                                    $('#warnet-table').DataTable().ajax.reload();
                                }
                            });
                        }
                    })
            });
    </script>
    @endsection

