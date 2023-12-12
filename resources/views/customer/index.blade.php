@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Akun')
@section('script_head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Customer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Customer</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Customer</h3>
        </div>
        <div class="card-body p-0" style="margin: 20px">
            <table id="customerTable" class="table table-striped table-bordered display" style="width:100%">
                <a href="{{ route('customer.add') }}" class="btn btn-primary">Tambah Customer</a>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Billing</th>
                        <th>No. Telp</th>
                        <th>Create Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
@endsection

@section('script_footer')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#customerTable').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ route('customer.dataTable') }}",
                "type": "GET",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "columns": [{
                    "data": "nama_customer",
                    "name": "nama_customer"
                },
                {
                    "data": "username",
                    "name": "username"
                },
                {
                    "data": "billing",
                    "name": "billing"
                },
                {
                    "data": "no_telp",
                    "name": "no_telp"
                },
                {
                    "data": "create_date",
                    "name": "create_date"
                },
                {
                    "data": "options",
                    "name": "options"
                }
            ],
        });

        // hapus data
        $('#customerTable').on('click', '.hapusData', function() {
            var id_customer = $(this).data("id");
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
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "id_customer": id_customer,
                                "_token": "{{csrf_token()}}"
                            },
                            success: function(response) {
                                Swal.fire('Terhapus!', response.msg, 'success');
                                $('#customerTable').DataTable().ajax.reload();
                            }
                        });
                    }
                })
        });
    });
</script>
@endsection