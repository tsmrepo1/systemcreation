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
                            <li class="breadcrumb-item active" aria-current="page">Trip Report</li>
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
                                <form class="row g-3 mt-3" method="POST" action="{{ route('broker.payment_report') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Broker Name</label>
                                            <select class="single-select" name="broker_id">
                                                <option value="">--select--</option>
                                                
                                                @foreach($brokers as $broker)
                                                    <option value="{{ $broker->id }}" 
                                                    <?php if(isset($broker_id) && $broker_id == $broker->id) echo "selected";?>>{{ $broker->broker_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">From Date</label>
                                            <input type="date" class="form-control"  name="from_date" value="<?php if(isset($from_date)) echo $from_date ?>" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">To Date</label>
                                            <input type="date" class="form-control"  name="to_date" value="<?php if(isset($to_date)) echo $to_date ?>" />
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary mt-4">View</button>
                                        </div>
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
                                            <th>Sl</th>
                                            <th>Broker Name</th>
                                            <th>Challan Date</th>
                                            <th>Vehicle No</th>
                                            <th>Challan No</th>
                                            <th>Owner</th>
                                            <th>Broker Commission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $record)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $record->broker_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($record->challan_date)) }}</td>
                                                <td>{{ $record->vehicle_no }}</td>
                                                <td>{{ $record->challan_no }}</td>
                                                <td>{{ $record->owners_name }}</td>
                                                <td>{{ $record->broker_commission }}</td>
                                            </tr>
                                        @endforeach
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
    

</x-app-layout>
