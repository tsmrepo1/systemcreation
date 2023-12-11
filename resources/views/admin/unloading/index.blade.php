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
                <div class="breadcrumb-title pe-3">Unloading</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Unloading Records</li>
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
                                <table class="table table-bordered" id="datatable">
                                    <thead>
                                        <tr class="table-dark text-light">
                                            <th scope="col">SL No.</th>
                                            <th scope="col">Challan Date</th>
                                            <th scope="col">Challan No</th>
                                            <th scope="col">Vehicle No</th>
                                            <th scope="col">Owner Name</th>
                                            <th scope="col">Unloading Qty</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($unloadings as $unloading) @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$unloading->loading->date}}</td>
                                                <td>{{$unloading->loading->challan_no}}</td>
                                                
                                                <td>{{$unloading->vehicle->vehicle_no}}</td>
                                                <td>{{$unloading->vehicle->owners_name}}</td>
                                                <td>{{$unloading->qty}}</td>
                                                <td class="text-end">
                                                    <div class="btn-group">
                                                        <button 
                                                            class="btn btn-info btn-sm mx-1 viewModal"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#previewModal"
                                                            data-loading_id="{{ $unloading->loading_id }}"
                                                            data-loading_date="{{ $unloading->loading->date }}"
                                                            data-broker_name="{{ $unloading->broker->broker_name }}"
                                                            data-vehicle_no="{{ $unloading->vehicle->vehicle_no }}"
                                                            data-product_name="{{ $unloading->product->product_name }}"
                                                            data-loading_quantity="{{ $unloading->loading->qty }}"
                                                            data-loading_unit="{{ $unloading->loading->unit }}"
                                
                                                            data-unloading_point="{{ $unloading->unloading_point }}"
                                                            data-unloading_quantity="{{ $unloading->qty }}"
                                                            data-unloading_date="{{ $unloading->unloading_date }}"
                                                            data-challan_receiving_date="{{ $unloading->challan_receiving_date }}"
                                                            ><i class="fadeIn animated bx bx-show-alt"></i></button>
                                                            
                                                        <button 
                                                            class="btn btn-primary btn-sm mx-1 editModal"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editModal"
                                                            data-id="{{ $unloading->id }}"
                                                            data-loading_id="{{ $unloading->loading_id }}"
                                                            data-loading_date="{{ $unloading->loading->date }}"
                                                            data-broker_name="{{ $unloading->broker->broker_name }}"
                                                            data-vehicle_no="{{ $unloading->vehicle->vehicle_no }}"
                                                            data-product_name="{{ $unloading->product->product_name }}"
                                                            data-loading_quantity="{{ $unloading->loading->qty }}"
                                                            data-loading_unit="{{ $unloading->loading->unit }}"
                                
                                                            data-unloading_point="{{ $unloading->unloading_point }}"
                                                            data-unloading_quantity="{{ $unloading->qty }}"
                                                            data-unloading_date="{{ $unloading->unloading_date }}"
                                                            data-challan_receiving_date="{{ $unloading->challan_receiving_date }}"
                                                            ><i class="fadeIn animated bx bx-edit"></i></button>
                                                            
                                                        <form method="post" action="{{route('unloadings.destroy',$unloading->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="confirm('Are you sure to delete?')" class="btn btn-danger btn-sm mx-1">
                                                                <i class="fadeIn animated bx bx-trash-alt"></i>
                                                            </button>
                                                        </form>
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
    
    <!-- The Modal -->
    <div class="modal fade" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Preview Unloading Entry</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
    
             <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Challan No</label>
                        <select name="loading_id_input" class="form-select" disabled readonly>
                            <option value="" {{ old('loading_id') == "" ? "selected" : "" }}>Select</option>

                            @foreach($loadings as $loading)
                            <option value="{{$loading->id}}" {{ old('loading_id') == $loading->id ? "selected" : "" }}>{{$loading->challan_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-9"></div>
                    
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Loading Date</label>
                        <input type="text" class="form-control" name="loading_date_input" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Broker Name</label>
                        <input type="text" class="form-control" name="broker_name_input" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Vehicle No</label>
                        <input type="text" class="form-control" name="vehicle_no_input" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3"></div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Product</label>
                        <input type="text" class="form-control" name="product_name_input" disabled  readonly>
                    </div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity_input" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Unit</label>
                        <input type="text" class="form-control" name="unit_input" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3"></div>
                    

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Unloading Point</label>
                            <input type="text" class="form-control" name="unloading_point_input" value="balasore" disabled readonly>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="qty_input" disabled readonly>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="unloading_date_input" disabled readonly>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Challan Receiving Date</label>
                            <input type="date" class="form-control" name="challan_receiving_date_input" disabled readonly>
                        </div>
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
    
    <!-- The Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-xl">
        <form action="" method="POST" id="editForm">
        @method("PUT")
        @csrf
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Preview Unloading Entry</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
    
             <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Challan No</label>
                        <select name="loading_id" class="form-select" disabled readonly>
                            <option value="" {{ old('loading_id') == "" ? "selected" : "" }}>Select</option>

                            @foreach($loadings as $loading)
                            <option value="{{$loading->id}}" {{ old('loading_id') == $loading->id ? "selected" : "" }}>{{$loading->challan_no}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-9"></div>
                    
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Loading Date</label>
                        <input type="text" class="form-control" name="loading_date" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Broker Name</label>
                        <input type="text" class="form-control" name="broker_name" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Vehicle No</label>
                        <input type="text" class="form-control" name="vehicle_no" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3"></div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Product</label>
                        <input type="text" class="form-control" name="product_name" disabled  readonly>
                    </div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3 data">
                        <label for="inputMobile" class="form-label">Unit</label>
                        <input type="text" class="form-control" name="unit" disabled readonly>
                    </div>
                    <div class="col-md-3 mb-3"></div>
                    

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Unloading Point</label>
                            <input type="text" class="form-control" name="unloading_point" value="balasore" disabled readonly>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="qty">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="unloading_date">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label">Challan Receiving Date</label>
                            <input type="date" class="form-control" name="challan_receiving_date">
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-success mx-1" onclick="submit()">Save</button>
                    <button type="button" class="btn btn-danger mx-1" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        </form>
      </div>
    </div>
    
    <script>
        $(".viewModal").on("click", function (event) {
            $("select[name='loading_id_input']").val($(this).data("loading_id"))
            
    
            $("input[name='loading_date_input']").val($(this).data("loading_date"))
            $("input[name='broker_name_input']").val($(this).data("broker_name"))
            $("input[name='vehicle_no_input']").val($(this).data("vehicle_no"))
            $("input[name='product_name_input']").val($(this).data("product_name"))
            $("input[name='quantity_input']").val($(this).data("loading_quantity"))
            $("input[name='unit_input']").val($(this).data("loading_unit"))
            
            $("input[name='unloading_point_input']").val($(this).data("unloading_point"))
            $("input[name='qty_input']").val($(this).data("unloading_quantity"))
            $("input[name='unloading_date_input']").val($(this).data("unloading_date"))
            $("input[name='challan_receiving_date_input']").val($(this).data("challan_receiving_date"))
        })
        
        function submit() {
            $("#form").submit()
        }
        
        $("select[name='loading_id[]']").on("change", function(event) {
            
            let value = $(this).val()
            
            fetch(`{{ url('/loadings') }}/${value}`)
            .then(response => response.json())
            .then(data => {
                $("input[name='loading_date[]']").val(data.data.loading_date)
                $("input[name='broker_name[]']").val(data.data.broker_name)
                $("input[name='vehicle_no[]']").val(data.data.vehicle_no)
                $("input[name='product_name[]']").val(data.data.product_name)
                $("input[name='quantity[]']").val(data.data.qty)
                $("input[name='unit[]']").val(data.data.unit)
            })
            .catch(error => console.log(error))
        })
    </script>
    
    <script>
        $(".editModal").on("click", function (event) {
            $("#editForm").attr("action",  `{{ url('/unloadings') }}/${$(this).data("id")}`)
           
            $("select[name='loading_id']").val($(this).data("loading_id"))
            $("input[name='loading_date']").val($(this).data("loading_date"))
            $("input[name='broker_name']").val($(this).data("broker_name"))
            $("input[name='vehicle_no']").val($(this).data("vehicle_no"))
            $("input[name='product_name']").val($(this).data("product_name"))
            $("input[name='quantity']").val($(this).data("loading_quantity"))
            $("input[name='unit']").val($(this).data("loading_unit"))
            
            $("input[name='unloading_point']").val($(this).data("unloading_point"))
            $("input[name='qty']").val($(this).data("unloading_quantity"))
            $("input[name='unloading_date']").val($(this).data("unloading_date"))
            $("input[name='challan_receiving_date']").val($(this).data("challan_receiving_date"))
        })
        
        function submit() {
            $("#form").submit()
        }
        
        $("select[name='loading_id[]']").on("change", function(event) {
            
            let value = $(this).val()
            
            fetch(`{{ url('/loadings') }}/${value}`)
            .then(response => response.json())
            .then(data => {
                $("input[name='loading_date[]']").val(data.data.loading_date)
                $("input[name='broker_name[]']").val(data.data.broker_name)
                $("input[name='vehicle_no[]']").val(data.data.vehicle_no)
                $("input[name='product_name[]']").val(data.data.product_name)
                $("input[name='quantity[]']").val(data.data.qty)
                $("input[name='unit[]']").val(data.data.unit)
            })
            .catch(error => console.log(error))
        })
    </script>

    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>