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
                            <form class="row g-3" method="POST" action="{{route('unloadings.store')}}?type=multiple" id="form">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="table">
                                        <thead>
                                            <tr class="table-dark text-center">
                                                <th>SL. No</th>
                                                <th>Challan No</th>
                                                <th>L-Date</th>
                                                <th>Broker</th>
                                                <th>Vehicle No</th>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                                <th>Product</th>
                                                <th>U-Point</th>
                                                <th>U-Qty</th>
                                                <th>U-Date</th>
                                                <th>Challan Receiving Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="form-control form-control-sm" name="sl_no[]" value="1" readonly style="width: 60px !important;"> 
                                                </td>
                                                <td>
                                                    <select name="loading_id[]" class="single-select form-select-sm">
                                                        <option value="" {{ old('loading_id') == "" ? "selected" : "" }}>Select</option>
                
                                                        @foreach($loadings as $loading)
                                                        <option value="{{$loading->id}}" {{ old('loading_id') == $loading->id ? "selected" : "" }}>{{$loading->challan_no}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('loading_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="loading_date" disabled readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="broker_name" disabled readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="vehicle_no" disabled readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="product_name" disabled readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="quantity" disabled readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="unit" disabled readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="unloading_point[]" value="balasore" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="qty[]">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="unloading_date[]">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="challan_receiving_date[]">
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
                                    <button type="button" class="btn btn-primary" id="save_btn">Save</button>
                                </div>
                            </form>
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
                <h4 class="modal-title">Preview GR/Challan Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
    
             <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="inputDate" class="form-label">Challan No</label>
                        <select name="loading_id_input" class="single-select form-select-sm" disabled readonly>
                            <option value="" {{ old('loading_id') == "" ? "selected" : "" }}>Select</option>

                            @foreach($loadings as $loading)
                            <option value="{{$loading->id}}" {{ old('loading_id') == $loading->id ? "selected" : "" }}>{{$loading->challan_no}}</option>
                            @endforeach
                        </select>
                        @error('loading_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
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
    
    <script>
        $("#save_btn").on("click", function() {
            $("#form").submit()
        })
        
        $(".btn-row-add").on("click", function() {
            let total_rows = $("tbody").children()
            
            $("tbody").append(`
                <tr>
                    <td>
                        <input class="form-control form-control-sm" name="sl_no[]" value="1" readonly style="width: 60px !important;"> 
                    </td>
                    <td>
                        <select name="loading_id[]" class="single-select form-select-sm">
                            <option value="" {{ old('loading_id') == "" ? "selected" : "" }}>Select</option>

                            @foreach($loadings as $loading)
                            <option value="{{$loading->id}}" {{ old('loading_id') == $loading->id ? "selected" : "" }}>{{$loading->challan_no}}</option>
                            @endforeach
                        </select>
                        @error('loading_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control" name="loading_date" disabled readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="broker_name" disabled readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="vehicle_no" disabled readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="product_name" disabled readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="quantity" disabled readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="unit" disabled readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="unloading_point[]" value="balasore" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="qty[]">
                    </td>
                    <td>
                        <input type="date" class="form-control" name="unloading_date[]">
                    </td>
                    <td>
                        <input type="date" class="form-control" name="challan_receiving_date[]">
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm mx-1 btn-preview">Preview</button>
                            <button type="button" class="btn btn-danger btn-sm mx-1 btn-row-delete">Delete</button>
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
            
            $("select[name='loading_id_input']").val(element.find($("select[name='loading_id[]']")).val())
            
            $("input[name='loading_date_input']").val(element.find($("input[name='loading_date']")).val())
            $("input[name='broker_name_input']").val(element.find($("input[name='broker_name']")).val())
            $("input[name='vehicle_no_input']").val(element.find($("input[name='vehicle_no']")).val())
            $("input[name='product_name_input']").val(element.find($("input[name='product_name']")).val())
            $("input[name='quantity_input']").val(element.find($("input[name='quantity']")).val())
            $("input[name='unit_input']").val(element.find($("input[name='unit']")).val())
            
            $("input[name='unloading_point_input']").val(element.find($("input[name='unloading_point[]']")).val())
            $("input[name='qty_input']").val(element.find($("input[name='qty[]']")).val())
            $("input[name='unloading_date_input']").val(element.find($("input[name='unloading_date[]']")).val())
            $("input[name='challan_receiving_date_input']").val(element.find($("input[name='challan_receiving_date[]']")).val())
            
            var previewModal = new bootstrap.Modal(document.getElementById('previewModal'), {
              keyboard: false
            })
            
            previewModal.show()
        })
        
        $(document).on("change", "select[name='loading_id[]']",  function(event) {
            
            let parent  = $(this).parent().parent()
            let value   = $(this).val()
            
            console.log($(this))
            console.log(parent)
            
            
            
            fetch(`{{ url('/loadings') }}/${value}`)
            .then(response => response.json())
            .then(data => {
                parent.find("input[name='loading_date']").val(data.data.loading_date)
                parent.find("input[name='broker_name']").val(data.data.broker_name)
                parent.find("input[name='vehicle_no']").val(data.data.vehicle_no)
                parent.find("input[name='product_name']").val(data.data.product_name)
                parent.find("input[name='quantity']").val(data.data.qty)
                parent.find("input[name='unit']").val(data.data.unit)
            })
            .catch(error => console.log(error))
        })
    </script>
    


    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>