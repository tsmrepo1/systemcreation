<x-app-layout>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.css"> --}}
    <!--sidebar wrapper -->
    @include('inc.sidebar')
    <!--end sidebar wrapper -->

    <!--start header -->
    @include('inc.header')
    <!--end header -->

    <style>
        form input {
            width: 200px !important;
        }
        form select {
            width: 200px !important;
        }
    </style>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Owner Unbilled Trips</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Owner Unbilled Trips</li>
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
                                <h5 class="mb-0 text-primary">Trips</h5>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Challan Date</th>
                                            <th scope="col">Challan No</th>
                                            <th scope="col">Vehicle No</th>
                                            <th scope="col">Owner Name</th>
                                            <th scope="col">Owner Payble Amount</th>
                                            <th scope="col">Receiving Date</th>
                                            <th scope="col">Due Date</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        @php $i = 0 @endphp
                                        @foreach($records as $record) @php $i++ @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ date("d-m-Y", strtotime($record["challan_date"])) }}</td>
                                            <td>{{ $record["challan_no"] }}</td>
                                            <td>{{ $record["vehicle_no"] }}</td>
                                            <td>{{ $record["owner_name"] }}</td>
                                            <td>{{ $record["payble_balance"] }}</td>
                                            <td>{{ date("d-m-Y", strtotime($record["challan_receiving_date"])) }}</td>
                                            <td>{{ $record["due_date"] }}</td>
                                        </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>
