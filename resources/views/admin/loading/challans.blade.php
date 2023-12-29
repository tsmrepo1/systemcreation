<x-app-layout>
    <!--sidebar wrapper -->
    @include('inc.sidebar')
    <!--end sidebar wrapper -->

    <!--start header -->
    @include('inc.header')
    <!--end header -->

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Search By Challan</div>
            </div>
            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-1">
                <div class="col">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0 text-primary">Challans</h5>
                            </div>
                            <hr>
                            
                            <form action="{{ route('loadings.search.challan') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Challan No.</label>
                                            <select class="single-select" name="challan_no">
                                                <option value="" <?php if(isset($challan_no) && $challan_no == "") echo "selected" ?>>--select--</option>
                                                @foreach($challans as $challan)
                                                    <option value="{{ $challan->challan_no }}" 
                                                        <?php if(isset($challan_no) && $challan_no == $challan->challan_no) echo "selected" ?>>{{ $challan->challan_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary mt-4">Search</button>
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </div>
                    
                    @if(isset($loadings))
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0 text-primary">Loading Records</h5>
                            </div>
                            <hr>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Broker</th>
                                            <th>Challan date</th>
                                            <th>Vehicle No</th>
                                            <th>Challan No</th>
                                            <th>L.Qty</th>
                                            <th>UL.Qty</th>
                                            <th>Product</th>
                                            <th>L.Point</th>
                                            <th>UL.Point</th>
                                            <th>Fuel Amt.</th>
                                            <th>Cash Amt.</th>
                                            <th>Total Adv.</th>
                                            <th>Owner</th>
                                            <th>Price/MT</th>
                                            <th>Broker Commission</th>
                                            <th>Driver Commission</th>
                                            <th>Owner Bill No</th>
                                            <th>Client Bill No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loadings as $loading)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $loading->broker_name }}</td>
                                                <td>{{ $loading->date }}</td>
                                                <td>{{ $loading->vehicle_no }}</td>
                                                <td>{{ $loading->challan_no }}</td>
                                                <td>{{ $loading->qty }}</td>
                                                <td>{{ $loading->unloading_qty }}</td>
                                                <td>{{ $loading->product_name }}</td>
                                                <td>{{ $loading->loading_point }}</td>
                                                <td>{{ $loading->unloading_point }}</td>
                                                <td>{{ $loading->fuel_amount }}</td>
                                                <td>{{ $loading->cash_amount }}</td>
                                                <td>{{ $loading->fuel_amount + $loading->cash_amount }}</td>
                                                <td>{{ $loading->owner_name }}</td>
                                                <td>{{ $loading->price }}</td>
                                                <td>{{ $loading->broker_commission }}</td>
                                                <td>{{ $loading->driver_commission }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>