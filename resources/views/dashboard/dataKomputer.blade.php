@extends('dashboard.dashboardLayout')

@section('konten2')
<div class="content">
    <h2><strong>Data Komputer</strong></h2>
    <div class="row">


        @forelse ($data as $computer)
        <div class="col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $computer->nama_komputer }}</h5>
                    <p class="card-text">{{ $computer->processor }}</p>
                    <p class="card-text">{{ $computer->ram }}</p>
                    <p class="card-text">{{ $computer->gpu }}</p>

                    <!-- Button to Open Form Pop-up -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#beliModal{{ $computer->id_komputer }}">
                        Beli
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="beliModal{{ $computer->id_komputer }}" tabindex="-1" role="dialog"
                        aria-labelledby="beliModalLabel{{ $computer->id_komputer }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black" id="beliModalLabel{{ $computer->id_komputer }}">
                                        Beli
                                        Billing</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Your Form Goes Here -->
                                    <form action="{{ route('dataKomputer.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="billing" class="form-label text-black">Billing (jam)</label>
                                            <input type="text" class="form-control" id="billing" name="billing"
                                                value="{{ $computer->billing->billing ?? '' }}" required>
                                        </div>

                                        <!-- Gunakan variabel sebelumnya -->
                                        <input type="hidden" name="id_komputer" value="{{ $computer->id_komputer }}">
                                        <input type="hidden" name="id_warnet" value="{{ $computer->id_warnet }}">
                                        <input type="hidden" name="id_customer" value="{{ Auth::id() }}">

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('dataKomputer.index') }}" class="btn btn-secondary">Cancel</a>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h5 class="card-title text-black">No data available</h5>
        @endforelse
    </div>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
@endsection