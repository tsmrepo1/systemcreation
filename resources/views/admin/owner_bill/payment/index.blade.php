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
                <div class="breadcrumb-title pe-3">Owner Payment View</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Owner Payment View</li>
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
                                <h5 class="mb-0 text-primary">Payment List</h5>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL NO.</th>
                                            <th scope="col">Owner Name</th>
                                            <th scope="col">Voucher No</th>
                                            <th scope="col">Payment Date</th>
                                            <th scope="col">Invoice Amount</th>
                                            <th scope="col">Payment Amount</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        @php $i = 0 @endphp
                                        @foreach($records as $record) @php $i++ @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $record["owner_name"] }}</td>
                                            <td>{{ $record["receipt"] }}</td>
                                            <td>{{ date("d-m-Y", strtotime($record["created_at"])) }}</td>
                                            <td>{{ $record["invoice_amount"] }}</td>
                                            <td>{{ $record["payment_amount"] }}</td>
                                            <td>{{ $record["balance"] }}</td>
                                            <td><span class="badge bg-success" style="background-color: #14A44D;">SUCCESS</span></td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('owner_bill.voucher', $record['id']) }}" class="btn btn-sm btn-primary mx-1">View Voucher</a>
                                                    
                                                    <button class="btn btn-sm btn-info mx-1">
                                                        Edit
                                                    </button>
                                                </div>
                                            </td>
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
