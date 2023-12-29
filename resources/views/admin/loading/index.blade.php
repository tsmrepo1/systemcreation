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
                <div class="breadcrumb-title pe-3">Broker</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Broker</li>
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
                                <h5 class="mb-0 text-primary">Loading Records</h5>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable">
                                    <thead>
                                        <tr class="table-dark">
                                            <th scope="col">SL No.</th>
                                            <th scope="col">Challan Date</th>
                                            <th scope="col">Challan No</th>
                                            <th scope="col">Vehicle Number</th>
                                            <th scope="col">Owner's Name</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loadings as $loading)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{date('d-m-Y', strtotime($loading->date))}}</td>
                                                <td>{{$loading->challan_no}}</td>
                                                <td>{{$loading->vehicle->vehicle_no}}</td>
                                                <td>{{$loading->vehicle->owners_name}}</td>
                                                <td class="text-end">
                                                    <div class="btn-group">
                                                        <button 
                                                            class="btn btn-info btn-sm mx-1 viewModal"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#previewModal"
                                                            
                                                            data-broker_id="{{$loading->broker_id}}"
                                                            data-vehicle_id="{{$loading->vehicle_id}}"
                                                            data-product_id="{{$loading->product_id}}"
                                                            data-client_id="{{$loading->client_id}}"
                                                            data-fuel_station_id="{{$loading->fuel_station_id}}"
                                                            data-cashier_id="{{$loading->cashier_id}}"
                                                            
                                                            data-date="{{$loading->date}}"
                                                            data-challan_no="{{$loading->challan_no}}"	
                                                            data-qty="{{$loading->qty}}"
                                                            data-unit="{{$loading->unit}}"
                                                            
                                                            data-unloading_point="{{$loading->unloading_point}}"
                                                            data-fuel_amount="{{$loading->fuel_amount}}"
                                                            data-cash_amount="{{$loading->cash_amount}}"
                                                            data-bank_advance="{{$loading->bank_advance}}"
                                                            data-dock_loading_charges="{{$loading->dock_loading_charges}}"
                                                            
                                                            data-driver_commission="{{$loading->driver_commission}}"
                                                            data-broker_commission="{{$loading->broker_commission}}"
                                                            
                                                            data-owner_name=""
                                                            data-owner_bill_no=""
                                                            data-client_bill_no=""
                                                            data-created_by=""	 
                                                            data-updated_by=""
                                                            ><i class="fadeIn animated bx bx-show-alt"></i></button>
                                                            
                                                        <button 
                                                            class="btn btn-primary btn-sm mx-1 editModal"
                                                            
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editModal"
                                                            
                                                            data-id="{{ $loading->id }}"
                                                            data-broker_id="{{$loading->broker_id}}"
                                                            data-vehicle_id="{{$loading->vehicle_id}}"
                                                            data-product_id="{{$loading->product_id}}"
                                                            data-client_id="{{$loading->client_id}}"
                                                            data-fuel_station_id="{{$loading->fuel_station_id}}"
                                                            data-cashier_id="{{$loading->cashier_id}}"
                                                            
                                                            data-date="{{$loading->date}}"
                                                            data-challan_no="{{$loading->challan_no}}"	
                                                            data-qty="{{$loading->qty}}"
                                                            data-unit="{{$loading->unit}}"
                                                            
                                                            data-unloading_point="{{$loading->unloading_point}}"
                                                            data-fuel_amount="{{$loading->fuel_amount}}"
                                                            data-cash_amount="{{$loading->cash_amount}}"
                                                            data-bank_advance="{{$loading->bank_advance}}"
                                                            data-dock_loading_charges="{{$loading->dock_loading_charges}}"
                                                            
                                                            data-driver_commission="{{$loading->driver_commission}}"
                                                            data-broker_commission="{{$loading->broker_commission}}"
                                                            
                                                            data-owner_name=""
                                                            data-owner_bill_no=""
                                                            data-client_bill_no=""
                                                            data-created_by=""	 
                                                            data-updated_by=""><i class="fadeIn animated bx bx-edit"></i></button>
                                                        <button class="btn btn-danger btn-sm mx-1"><i class="fadeIn animated bx bx-trash-alt"></i></button>
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
    
    <!-- The View Modal -->
    <div class="modal fade" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Loading Record</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="inputMenberName" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="introducer_id" class="form-label">Broker Name</label>
                        <select name="broker_id" class="form-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($brokers as $broker)
                            <option value="{{$broker->id}}">{{$broker->broker_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputEmail" class="form-label">Challan No</label>
                        <input type="text" class="form-control" name="challan_no" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Vehicle No</label>
                        <select name="vehicle_id" class="form-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}">{{$vehicle->vehicle_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputMobile" class="form-label">Loading Qty</label>
                        <input type="text" class="form-control" name="qty" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Product</label>
                        <select name="product_id" class="form-select" disabled readonly>
                            <option value="">Select</option>

                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->product_name}} - ({{$product->loading_point}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Loading Point</label>
                        <select name="fuel_station_id" class="form-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->fuel_station_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Unloading Point</label>
                        <select name="unloading_point" class="form-select" disabled readonly>
                            <option value="">Select</option>
                            <option value="balasore">Balasore</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Unloading Quantity</label>
                        <input type="text" class="form-control" value=""  readonly/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Fuel Amount</label>
                        <input type="text" class="form-control" name="fuel_amount" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Cash Amount</label>
                        <input type="text" class="form-control" name="cash_amount" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Total Amount</label>
                        <input type="text" class="form-control" name="total_advance" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Driver Commission</label>
                        <input type="text" class="form-control" name="driver_commission" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Broker Commission</label>
                        <input type="text" class="form-control" name="broker_commission" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Owner's Name</label>
                        <input type="text" class="form-control" name="owner_name" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Owner's Bill No</label>
                        <input type="text" class="form-control" name="owner_bill_no" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Client's Name</label>
                        <select name="client_id" class="form-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->client_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Cashier's Name</label>
                        <select name="cashier_id" class="form-select" disabled readonly>
                            <option value="">Select</option>
                            @foreach($cashiers as $cashier)
                            <option value="{{$cashier->id}}">{{$cashier->cashier_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Bank Advance</label>
                        <input type="text" class="form-control" name="bank_advance" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Client's Bill No</label>
                        <input type="text" class="form-control" name="client_bill_no" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Created By</label>
                        <input type="text" class="form-control" name="created_by" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Updated By</label>
                        <input type="text" class="form-control" name="updated_by" readonly>
                    </div>
                </div>
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- The Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-xl">
        <form action="" method="POST" id="editForm">
        @method("PUT")
        @csrf
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Loading Record</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="inputMenberName" class="form-label">L.Date</label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="introducer_id" class="form-label">Broker Name</label>
                        <select name="broker_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($brokers as $broker)
                            <option value="{{$broker->id}}">{{$broker->broker_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Product</label>
                        <select name="product_id" class="form-select">
                            <option value="">Select</option>

                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->product_name}} -  ({{$product->loading_point}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputMobile" class="form-label">Qty</label>
                        <input type="text" class="form-control" name="qty">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Client's Name</label>
                        <select name="client_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->client_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Vehicle No</label>
                        <select name="vehicle_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}">{{$vehicle->vehicle_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputEmail" class="form-label">Challan No</label>
                        <input type="text" class="form-control" name="challan_no">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Unloading Point</label>
                        <select name="unloading_point" class="form-select">
                            <option value="">Select</option>
                            <option value="balasore">Balasore</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Fuel Station</label>
                        <select name="fuel_station_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->fuel_station_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Fuel Amount</label>
                        <input type="text" class="form-control" name="fuel_amount">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Cash Amount</label>
                        <input type="text" class="form-control" name="cash_amount">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Cashier's Name</label>
                        <select name="cashier_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($cashiers as $cashier)
                            <option value="{{$cashier->id}}">{{$cashier->cashier_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Bank Advance</label>
                        <input type="text" class="form-control" name="bank_advance">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Dock Loading Charges</label>
                        <input type="text" class="form-control" name="dock_loading_charges">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Driver Commission</label>
                        <input type="text" class="form-control" name="driver_commission">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Broker Commission</label>
                        <input type="text" class="form-control" name="broker_commission">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control d-none" name="id">
                    </div>
                </div>
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save</button>
            
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
        </form>
      </div>
    </div>
    
    <script>
        $(".viewModal").on("click", function(event) {
            $(".modal").find("select[name='broker_id']").val($(this).data("broker_id"))
            $(".modal").find("select[name='vehicle_id']").val($(this).data("vehicle_id"))
            $(".modal").find("select[name='product_id']").val($(this).data("product_id"))
            $(".modal").find("select[name='client_id']").val($(this).data("client_id"))
            $(".modal").find("select[name='fuel_station_id']").val($(this).data("fuel_station_id"))
            $(".modal").find("select[name='cashier_id']").val($(this).data("cashier_id"))
            
            $(".modal").find("input[name='date']").val($(this).data("date"))
            $(".modal").find("input[name='challan_no']").val($(this).data("challan_no"))
            $(".modal").find("input[name='qty']").val($(this).data("qty"))
            $(".modal").find("input[name='unit']").val($(this).data("unit"))
            
            $(".modal").find("select[name='unloading_point']").val($(this).data("unloading_point"))
            $(".modal").find("input[name='fuel_amount']").val($(this).data("fuel_amount"))
            $(".modal").find("input[name='cash_amount']").val($(this).data("cash_amount"))
            $(".modal").find("input[name='total_advance']").val(Number($(this).data("fuel_amount")) + Number($(this).data("cash_amount")))
            
            $(".modal").find("input[name='bank_advance']").val($(this).data("bank_advance"))
            $(".modal").find("input[name='dock_loading_charges']").val($(this).data("dock_loading_charges"))
            
            $(".modal").find("input[name='driver_commission']").val($(this).data("driver_commission"))
            $(".modal").find("input[name='broker_commission']").val($(this).data("broker_commission"))
            $(".modal").find("input[name='owner_name']").val($(this).data("owner_name"))
            $(".modal").find("input[name='owner_bill_no']").val($(this).data("owner_bill_no"))
            $(".modal").find("input[name='client_bill_no']").val($(this).data("client_bill_no"))
            $(".modal").find("input[name='created_by']").val($(this).data("created_by"))
            $(".modal").find("input[name='updated_by']").val($(this).data("updated_by"))
        })
    </script>
    
    <script>
        $(".editModal").on("click", function(event) {
            $("#editForm").attr("action",  `{{ url('/loadings') }}/${$(this).data("id")}`)
            
            $(".modal").find("input[name='id']").val($(this).data("id"))
            
            $(".modal").find("select[name='broker_id']").val($(this).data("broker_id"))
            $(".modal").find("select[name='vehicle_id']").val($(this).data("vehicle_id"))
            $(".modal").find("select[name='product_id']").val($(this).data("product_id"))
            $(".modal").find("select[name='client_id']").val($(this).data("client_id"))
            $(".modal").find("select[name='fuel_station_id']").val($(this).data("fuel_station_id"))
            $(".modal").find("select[name='cashier_id']").val($(this).data("cashier_id"))
            
            $(".modal").find("input[name='date']").val($(this).data("date"))
            $(".modal").find("input[name='challan_no']").val($(this).data("challan_no"))
            $(".modal").find("input[name='qty']").val($(this).data("qty"))
            $(".modal").find("input[name='unit']").val($(this).data("unit"))
            
            $(".modal").find("select[name='unloading_point']").val($(this).data("unloading_point"))
            $(".modal").find("input[name='fuel_amount']").val($(this).data("fuel_amount"))
            $(".modal").find("input[name='cash_amount']").val($(this).data("cash_amount"))
            $(".modal").find("input[name='total_advance']").val(Number($(this).data("fuel_amount")) + Number($(this).data("cash_amount")))
            
            $(".modal").find("input[name='bank_advance']").val($(this).data("bank_advance"))
            $(".modal").find("input[name='dock_loading_charges']").val($(this).data("dock_loading_charges"))
            
            $(".modal").find("input[name='driver_commission']").val($(this).data("driver_commission"))
            $(".modal").find("input[name='broker_commission']").val($(this).data("broker_commission"))
            $(".modal").find("input[name='owner_name']").val($(this).data("owner_name"))
            $(".modal").find("input[name='owner_bill_no']").val($(this).data("owner_bill_no"))
            $(".modal").find("input[name='client_bill_no']").val($(this).data("client_bill_no"))
            $(".modal").find("input[name='created_by']").val($(this).data("created_by"))
            $(".modal").find("input[name='updated_by']").val($(this).data("updated_by"))
        })
    </script>
    
    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>