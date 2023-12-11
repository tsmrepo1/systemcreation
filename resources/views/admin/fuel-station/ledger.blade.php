<x-app-layout>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.css"> --}}
    <!--sidebar wrapper -->
    @include('inc.sidebar')
    <!--end sidebar wrapper -->

    <!--start header -->
    @include('inc.header')
    <!--end header -->

    <style>
        .is-invalid {
            border-color: red;
        }
    </style>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Fuel Station</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ledger</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-1">
                <div class="col">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Ledger</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="POST" action="{{ route('fuel.payment.generate_ledger') }}">
                                @csrf
                                <div class="col-md-3">
                                    <label class="form-label">From Date</label>
                                    <input type="date" class="form-control" name="from_date">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">To Date</label>
                                    <input type="date" class="form-control" name="to_date">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Pump</label>
                                    <select class="single-select" name="fuel_station_id">
                                        <option value="">--select--</option>
                                        @foreach($pumps as $pump)
                                            <option value="{{ $pump->id }}"> {{ $pump->fuel_station_name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary mt-4">Generate Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            @if(isset($records))
            <div class="row row-cols-1 row-cols-1">
                <div class="col">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Particullars</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $record)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $record['particulars'] }}</td>
                                                <td>{{ $record['debit'] }}</td>
                                                <td>{{ $record['credit'] }}</td>
                                                <td>{{ $record['balance'] }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-dark text-light">
                                            <td colspan="2">Closing Balance</td>
                                            <td>{{ $debit }}</td>
                                            <td>{{ $credit }}</td>
                                            <td>{{ $balance }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!--end page wrapper -->
    @include('inc.footer')
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script> --}}
</x-app-layout>
