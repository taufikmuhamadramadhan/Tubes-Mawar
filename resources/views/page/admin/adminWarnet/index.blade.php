@extends('layouts.base_admin.base_dashboard')@section('judul', 'List Akun')
@section('script_head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Admin Warnet</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Admin Warnet</li>
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
            <h3 class="card-title">Admin Warnet</h3>
            <!-- <div class="card-tools">
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                    title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="remove"
                    title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div> -->
        </div>
        <div class="card-body p-0" style="margin: 20px">
            <table id="previewAkun" class="table table-striped table-bordered display" style="width:100%">
                <a href="{{ route('adminWarnet.add') }}" class="btn btn-primary">Tambah Akun</a>
                <a href="{{ route('adminWarnet.export') }}" class="btn btn-danger ml-2">Export Data</a>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nama Warnet</th>
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
@endsection @section('script_footer')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#previewAkun').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ route('adminWarnet.dataTable') }}",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "columns": [{
                    "data": "name",
                    "name": "name"
                },
                {
                    "data": "email",
                    "name": "email"
                },
                {
                    "data": "nama_warnet",
                    "name": "nama_warnet"
                },
                {
                    "data": "options",
                    "name": "options"
                }
            ],

        });

        // hapus data
        $('#previewAkun').on('click', '.hapusData', function() {
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
                                $('#previewAkun').DataTable().ajax.reload();
                            }
                        });
                    }
                })
        });
    });
</script>
@endsection