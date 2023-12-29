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
                <div class="breadcrumb-title pe-3">Broker</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payment List</li>
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
                                <h5 class="mb-0 text-primary">Records</h5>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
										    <th scope="col">Sl No</th>
										    <th scope="col">Payment Date</th>
										    <th scope="col">Broker</th>
										    <th scope="col">Payment Amount</th>
										    <th scope="col">Discount Recieved</th>
										    <th scope="col" class="text-end">Action</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $record)
                                            <tr>
    										    <td>{{ $loop->iteration }}</td>
    										    <td>{{ date('d-m-Y', strtotime($record->payment_date)) }}</td>
    										    <td>{{ $record->broker_name }}</td>
    										    <td>{{ $record->payment_amount }}</td>
    										    <td>{{ $record->discount_received }}</td>
    										    <td class="text-end">
    										        <div class="btn-group">
    										            <button class="btn btn-sm btn-primary mx-1">View Challans</button>
    										            <button class="btn btn-sm btn-primary mx-1">Money Receipt</button>
    										        </div>
    										        
    										    </td>
    										</tr>
                                        @endforeach
                                    </tbody>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script> --}}
</x-app-layout>
