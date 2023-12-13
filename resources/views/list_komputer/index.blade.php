@extends('layouts.base_admin.base_dashboard')

@section('script_head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Komputer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">List Komputer</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-body p-0" style="margin: 20px">
            <table id="dataKomputer" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 15%">Nama Warnet</th>
                        <th style="width: 15%">ID Komputer</th>
                        <th style="width: 15%">Processor</th>
                        <th style="width: 15%">Ram</th>
                        <th style="width: 15%">GPU</th>
                        <th style="width: 15%">Harga</th>
                        <th style="width: 25%">Action</th>
                    </tr>
                </thead>
                <tbody> </tbody>
            </table>
            <div class="col-sm-12 col-md-7">
                <a href="{{ route('list_komputer.create') }}" class="btn btn-primary">Tambah Komputer</a>
                <a href="{{ route('list_komputer.exportPdf') }}" class="btn btn-success">Export PDF</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script_footer')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataKomputer').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ route('list_komputer.dataTable') }}",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "columns": [{
                    "data": "nama_warnet",
                    "name": "nama_warnet"
                },
                {
                    "data": "id_komputer",
                    "name": "id_komputer"
                },
                {
                    "data": "processor",
                    "name": "processor"
                },
                {
                    "data": "ram",
                    "name": "ram"
                },
                {
                    "data": "gpu",
                    "name": "gpu"
                },
                {
                    "data": "harga", // Added 'harga' column
                    "name": "harga"
                },
                {
                    "data": "options",
                    "name": "options"
                },
            ],

        });

        // hapus data
        $('#dataKomputer').on('click', '.hapusData', function() {
            var id_komputer = $(this).data("id_komputer");
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
                                "id_komputer": id_komputer,
                                "_token": "{{csrf_token()}}"
                            },
                            success: function(response) {
                                //console.log();
                                Swal.fire('Terhapus!', response.msg, 'success');
                                $('#dataKomputer').DataTable().ajax.reload();
                            }
                        });
                    }
                })
        });
    });
</script>
@endsection