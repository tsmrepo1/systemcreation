<x-app-layout>
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
        .select2 {
            width: 200px !important;
        }
    </style>

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Multiple Loading Entry</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Loading Entry</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <div class="row row-cols-1 row-cols-1">
                <div class="col">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Enter GR/Challan Details</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="POST" action="{{route('loadings.store')}}?type=multiple" id="form">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="table">
                                        <thead>
                                            <tr class="table-dark text-center">
                                                <th>SL. No</th>
                                                <th>L.Date</th>
                                                <th>Broker</th>
                                                <th>Challan No</th>
                                                <th>Vehicle No                                     
                                                    <button type="button" class="btn btn-outline-light btn-sm ms-2 mb-2"  data-bs-toggle="modal" data-bs-target="#carModal">
                                                        <i class="bx bx-car me-0 font-22"></i>
                                                        <i class="bx bx-plus me-0 font-22"></i>
                                                     </button>
                                                </th>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                                <th>Client Name</th>
                                                <th>Product</th>
                                                <th>U-Point</th>
                                                <th>Fuel Station</th>
                                                <th>Fuel Amount</th>
                                                <th>Cashier Name</th>
                                                <th>Cash Amount</th>
                                                <th>Bank Advance</th>
                                                <th>Dock L. Charges</th>
                                                <th>D-Commission</th>
                                                <th>B-Commission</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="form-control form-control-sm" name="sl_no[]" value="1" readonly style="width: 60px !important;"> 
                                                </td>
                                                <td>
                                                    <input type="date" name="date[]" value="{{old('date')}}" class="form-control form-control-sm">
                                                    @error('date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select name="broker_id[]" class="single-select">
                                                        <option value=""  {{ old('broker_id') == "" ? "selected" : "" }}>Select</option>
                                                        @foreach($brokers as $broker)
                                                        <option value="{{$broker->id}}"  {{ old('broker_id') == $broker->id ? "selected" : "" }}>{{$broker->broker_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('broker_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="{{old('challan_no')}}" name="challan_no[]">
                                                    @error('challan_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select name="vehicle_id[]" class="single-select">
                                                        <option value="" {{ old('vehicle_id') == "" ? "selected" : "" }}>Select</option>
                                                        @foreach($vehicles as $vehicle)
                                                        <option value="{{$vehicle->id}}"  {{ old('vehicle_id') == $vehicle->id ? "selected" : "" }}>{{$vehicle->vehicle_no}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('vehicle_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="{{old('qty')}}" name="qty[]">
                                                    @error('qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="MT" name="unit[]" readonly>
                                                    @error('unit')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select name="client_id[]" class="single-select">
                                                        <option value=""  {{ old('client_id') == "" ? "selected" : "" }}>Select</option>
                
                                                        @foreach($clients as $client)
                                                        <option value="{{$client->id}}"  {{ old('client_id') == $client->id ? "selected" : "" }}>{{$client->client_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('client_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select name="product_id[]" class="single-select">
                                                        <option value="" {{ old('product_id') == "" ? "selected" : "" }}>Select</option>
                                                    </select>
                                                    @error('product_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select name="unloading_point[]" class="single-select">
                                                        <option value="balasore">Balasore</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="fuel_station_id[]" class="single-select">
                                                        <option value=""  {{ old('fuel_station_id') == "" ? "selected" : "" }}>Select</option>
                                                        @foreach($stations as $station)
                                                        <option value="{{$station->id}}"  {{ old('fuel_station_id') == $station->id ? "selected" : "" }}>{{$station->fuel_station_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('fuel_station_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="{{old('fuel_amount')}}" name="fuel_amount[]">
                                                    @error('fuel_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <select name="cashier_id[]" class="single-select">
                                                        <option value=""  {{ old('cashier_id') == "" ? "selected" : "" }}>Select</option>
                                                        @foreach($cashiers as $cashier)
                                                        <option value="{{$cashier->id}}"  {{ old('cashier_id') == $cashier->id ? "selected" : "" }}>{{$cashier->cashier_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('cashier_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="{{old('cash_amount')}}" name="cash_amount[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="{{old('bank_advance')}}" name="bank_advance[]">
                                                    @error('bank_advance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="{{old('dock_loading_charges')}}" name="dock_loading_charges[]">
                                                    @error('dock_loading_charges')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                     <input type="text" class="form-control form-control-sm" value="{{old('driver_commission')}}" name="driver_commission[]">
                                                    @error('driver_commission')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" value="{{old('broker_commission')}}" name="broker_commission[]">
                                                    @error('broker_commission')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm mx-1 btn-preview">Preview</button>
                                                        <button type="button" class="btn btn-danger btn-sm mx-1 btn-row-delete">Delete</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="my-4">
                                    <button type="button" class="btn btn-dark btn-row-add">Add</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--The Car Add Modal-->
    <div class="modal fade" id="carModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="#" id="addVehicleForm">
            @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create Vehicle</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
        
                     <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="introducer_id" class="form-label">Vehicle No</label>
                                <input type="text" class="form-control" id="vehicle_no" value="{{old('vehicle_no')}}" name="vehicle_no">
                            </div>
        
                            <div class="col-md-3 mb-2">
                                <label for="inputMenberName" class="form-label">PAN No</label>
                                <input type="text" class="form-control" id="pan" value="{{old('pan')}}" name="pan">
                            </div>
        
                            <div class="col-md-3 mb-2">
                                <label for="inputEmail" class="form-label">Owner's Name</label>
                                <input type="text" class="form-control" id="owners_name" value="{{old('owners_name')}}" name="owners_name">
                            </div>
        
                            <div class="col-md-3 mb-2">
                                <label for="inputDate" class="form-label">Contact No</label>
                                <input type="text" class="form-control" id="contact_no" value="{{old('contact_no')}}" name="contact_no">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="inputMobile" class="form-label">A/C No</label>
                                <input type="text" class="form-control" id="account_no" value="{{old('account_no')}}" name="account_no">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="inputPassword" class="form-label">IFSC Code</label>
                                <input type="text" class="form-control" id="ifsc_code" value="{{old('ifsc_code')}}" name="ifsc_code">
                            </div>  
                            <div class="col-md-3 mb-2">
                                <label for="inputPanNumber" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" id="bank" value="{{old('bank')}}" name="bank" readonly>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="inputPassword" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" id="branch" value="{{old('branch')}}" name="branch" readonly>
                            </div>                 
                            <div class="col-md-3 mb-2">
                                <label for="inputPassword" class="form-label">Fund Transfer Type</label>
                                <select class="single-select" id="fund_transfer_type" name="fund_transfer_type">
                                    <option value="">--select--</option>
                                    <option value="NEFT">NEFT</option>
                                    <option value="RTGS"}>RTGS</option>
                                    <option value="IMPS">IMPS</option>
                                    <option value="Phone Pay"}>Phone Pay</option>
                                    <option value="Google Pay">Google Pay</option>
                                    <option value="Paytm">Paytm</option>
                                    <option value="UPI">UPI</option>
                                    <option value="">NA</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success mx-1">Save</button>
                            <button type="button" class="btn btn-danger mx-1" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- The Preview Modal -->
    <div class="modal fade" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Preview GR/Challan Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
    
             <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Product</label>
                        <select name="product_id_input" class="single-select" disabled readonly>
                            <option value="">Select</option>

                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->product_name}} - ({{$product->loading_point}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputMobile" class="form-label">Qty</label>
                        <input type="text" class="form-control form-control-sm" value="{{old('qty')}}" name="qty_input" readonly>
                    </div>
                    <div class="col-md-3 mb-3 d-none">
                        <label for="inputMobile" class="form-label">Unit</label>
                        <input type="text" class="form-control form-control-sm" value="MT" name="unit_input" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputMenberName" class="form-label">Date</label>
                        <input type="date" name="date_input" value="{{old('date')}}" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="introducer_id" class="form-label">Broker Name</label>
                        <select name="broker_id_input" class="single-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($brokers as $broker)
                            <option value="{{$broker->id}}">{{$broker->broker_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Client</label>
                        <select name="client_id_input" class="single-select" disabled readonly>
                            <option value="">Select</option>

                            @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->client_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Vehicle No</label>
                        <select name="vehicle_id_input" class="single-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}">{{$vehicle->vehicle_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputEmail" class="form-label">Challan No</label>
                        <input type="text" class="form-control form-control-sm" value="{{old('challan_no')}}" name="challan_no_input" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Unloading Point</label>
                        <select name="unloading_point_input" class="single-select" disabled readonly>
                            <option value="">Select</option>
                            <option value="balasore">Balasore</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Fuel Station</label>
                        <select name="fuel_station_id_input" class="single-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->fuel_station_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Fuel Amount</label>
                        <input type="text" class="form-control form-control-sm" value="{{old('fuel_amount')}}" name="fuel_amount_input" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Cash Amount</label>
                        <input type="text" class="form-control form-control-sm" value="{{old('cash_amount')}}" name="cash_amount_input" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputPassword" class="form-label">Cashier Name</label>
                        <select name="cashier_id_input" class="single-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($cashiers as $cashier)
                            <option value="{{$cashier->id}}">{{$cashier->cashier_name}}</option>
                            @endforeach
                        </select>
                    </div>                 
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Bank Advance</label>
                        <input type="text" class="form-control form-control-sm" value="{{old('bank_advance')}}" name="bank_advance_input" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Dock Loading Charges</label>
                        <input type="text" class="form-control form-control-sm" value="{{old('dock_loading_charges')}}" name="dock_loading_charges_input" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Driver Commission</label>
                        <input type="text" class="form-control form-control-sm" value="{{old('driver_commission')}}" name="driver_commission_input" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Broker Commission</label>
                        <input type="text" class="form-control form-control-sm" value="{{old('broker_commission')}}" name="broker_commission_input" readonly>
                    </div>
                </div>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger mx-1" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    
    <script>
        $(".btn-row-add").on("click", function() {
            let total_rows = $("tbody").children()
            
            $("tbody").append(`
                <tr>
                    <td>
                        <input class="form-control form-control-sm" name="sl_no[]" value="1" readonly style="width: 60px !important;"> 
                    </td>
                    <td>
                        <input type="date" name="date[]" value="{{old('date')}}" class="form-control form-control-sm">
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <select name="broker_id[]" class="single-select">
                            <option value=""  {{ old('broker_id') == "" ? "selected" : "" }}>Select</option>
                            @foreach($brokers as $broker)
                            <option value="{{$broker->id}}"  {{ old('broker_id') == $broker->id ? "selected" : "" }}>{{$broker->broker_name}}</option>
                            @endforeach
                        </select>
                        @error('broker_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" value="{{old('challan_no')}}" name="challan_no[]">
                        @error('challan_no')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <select name="vehicle_id[]" class="single-select">
                            <option value="" {{ old('vehicle_id') == "" ? "selected" : "" }}>Select</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}"  {{ old('vehicle_id') == $vehicle->id ? "selected" : "" }}>{{$vehicle->vehicle_no}}</option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" value="{{old('qty')}}" name="qty[]">
                        @error('qty')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" value="MT" name="unit[]" readonly>
                        @error('unit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <select name="client_id[]" class="single-select">
                            <option value=""  {{ old('client_id') == "" ? "selected" : "" }}>Select</option>

                            @foreach($clients as $client)
                            <option value="{{$client->id}}"  {{ old('client_id') == $client->id ? "selected" : "" }}>{{$client->client_name}}</option>
                            @endforeach
                        </select>
                        @error('client_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <select name="product_id[]" class="single-select">
                            <option value="" {{ old('product_id') == "" ? "selected" : "" }}>Select</option>
                        </select>
                        @error('product_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <select name="unloading_point[]" class="single-select">
                            <option value="balasore">Balasore</option>
                        </select>
                    </td>
                    <td>
                        <select name="fuel_station_id[]" class="single-select">
                            <option value=""  {{ old('fuel_station_id') == "" ? "selected" : "" }}>Select</option>
                            @foreach($stations as $station)
                            <option value="{{$station->id}}"  {{ old('fuel_station_id') == $station->id ? "selected" : "" }}>{{$station->fuel_station_name}}</option>
                            @endforeach
                        </select>
                        @error('fuel_station_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" value="{{old('fuel_amount')}}" name="fuel_amount[]">
                        @error('fuel_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <select name="cashier_id[]" class="single-select">
                            <option value=""  {{ old('cashier_id') == "" ? "selected" : "" }}>Select</option>
                            @foreach($cashiers as $cashier)
                            <option value="{{$cashier->id}}"  {{ old('cashier_id') == $cashier->id ? "selected" : "" }}>{{$cashier->cashier_name}}</option>
                            @endforeach
                        </select>
                        @error('cashier_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" value="{{old('cash_amount')}}" name="cash_amount[]">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" value="{{old('bank_advance')}}" name="bank_advance[]">
                        @error('bank_advance')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" value="{{old('dock_loading_charges')}}" name="dock_loading_charges[]">
                        @error('dock_loading_charges')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                         <input type="text" class="form-control form-control-sm" value="{{old('driver_commission')}}" name="driver_commission[]">
                        @error('driver_commission')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" value="{{old('broker_commission')}}" name="broker_commission[]">
                        @error('broker_commission')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary mx-1 btn-preview btn-sm">Preview</button>
                            <button type="button" class="btn btn-danger mx-1 btn-row-delete btn-sm">Delete</button>
                        </div>
                    </td>
                </tr>
            `)
            $("#table tbody tr:last .single-select").select2()
        })
        
        $(document).on("click", ".btn-row-delete", function(event) {
            $(this).parent().parent().parent().remove()
        })
        
        $(document).on("click", ".btn-row-add, .btn-row-delete", function() {
            $("input[name='sl_no[]']").each(function(index, element) {
                element.value = (index + 1)
            })
        })
        
        $(document).on("click", ".btn-preview", function(event) {
            let element = $(this).parent().parent().parent()
            console.log(element.find("input[name='sl_no[]']").val())
            
            $("select[name='broker_id_input']").val(element.find("select[name='broker_id[]']").val())
            $("select[name='vehicle_id_input']").val(element.find("select[name='vehicle_id[]']").val())
            $("select[name='product_id_input']").val(element.find("select[name='product_id[]']").val())
            $("select[name='client_id_input']").val(element.find("select[name='client_id[]']").val())
            $("select[name='fuel_station_id_input']").val(element.find("select[name='fuel_station_id[]']").val())
            $("select[name='cashier_id_input']").val(element.find("select[name='cashier_id[]']").val())
            $("select[name='unloading_point_input']").val(element.find("select[name='unloading_point[]']").val())
    
            $("input[name='date_input']").val(element.find("input[name='date[]']").val())
            $("input[name='challan_no_input']").val(element.find("input[name='challan_no[]']").val())
            $("input[name='qty_input']").val(element.find("input[name='qty[]']").val())
            $("input[name='unit_input']").val(element.find("input[name='unit[]']").val())
            $("input[name='fuel_amount_input']").val(element.find("input[name='fuel_amount[]']").val())
            $("input[name='cash_amount_input']").val(element.find("input[name='cash_amount[]']").val())
            $("input[name='bank_advance_input']").val(element.find("input[name='bank_advance[]']").val())
            $("input[name='dock_loading_charges_input']").val(element.find("input[name='dock_loading_charges[]']").val())
            $("input[name='driver_commission_input']").val(element.find("input[name='driver_commission[]']").val())
            $("input[name='broker_commission_input']").val(element.find("input[name='broker_commission[]']").val())
            
            var previewModal = new bootstrap.Modal(document.getElementById('previewModal'), {
              keyboard: false
            })
            
            previewModal.show()
        })
        
        $(document).on("change", "input[name='date[]']", function(event) {
            
            let date = $(this).val()
            
            let formdata = new FormData()
            formdata.append("loading_date", date)
            
            let element = $(this).parent().parent()
            element.find("select[name='product_id[]").empty()
            element.find("select[name='product_id[]").append(`<option value="">Select</option>`)   
            
            fetch("{{ route('products.search') }}", {
                headers: {
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
                method: "POST",
                body: formdata
            })
            .then(response => response.json())
            .then(data => {
                let element = $(this).parent().parent()
 
                if(data.length > 0) {
                    
                    data.forEach((product, index) => {
                        element.find("select[name='product_id[]").append(`<option value="${product.id}">${product.product_name} - (${product.loading_point})</option>`)    
                    })
                }
            })
            .catch(error => console.log(error))
        })
    </script>
    
    <script>
        $("#addVehicleForm").on("submit", function(event) {
            event.preventDefault()
            
            const formdata = new FormData(document.getElementById("addVehicleForm"))
            
            formdata.append("type", "API")
            
            fetch("{{ route('vehicles.store') }}", {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    method: "POST",
                    body: formdata
                }
            )
            .then(response => response.json())
            .then(data => {
                
                $("select[name='vehicle_id[]']").each(function(index, element) {
                    $(this).empty()    
                    $("select[name='vehicle_id_input']").empty()
                
                    data.forEach((record, index) => {
                        $(this).append(`<option value='${record.id}'>${record.vehicle_no}</option>`)
                        $("select[name='vehicle_id_input']").append(`<option value='${record.id}' selected>${record.vehicle_no}</option>`)
                    })
                })
                
                $('#carModal').modal('hide')
                $("#addVehicleForm").reset()
            })
        })
    </script>
    
    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>