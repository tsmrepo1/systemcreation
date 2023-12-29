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
                <div class="breadcrumb-title pe-3">Single Unloading Entry</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Unloading Entry</li>
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
                                <h5 class="mb-0 text-primary">Enter Unloading Details</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="POST" action="{{route('unloadings.store')}}?type=single" id="form">
                                @csrf
                                <div class="col-md-3">
                                    <label for="inputDate" class="form-label">Challan No</label>
                                    <select name="loading_id[]" class="single-select">
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
                                
                                <div class="col-md-3 data">
                                    <label for="inputMobile" class="form-label">Loading Date</label>
                                    <input type="text" class="form-control" name="loading_date[]" disabled readonly>
                                </div>
                                <div class="col-md-3 data">
                                    <label for="inputMobile" class="form-label">Broker Name</label>
                                    <input type="text" class="form-control" name="broker_name[]" disabled readonly>
                                </div>
                                <div class="col-md-3 data">
                                    <label for="inputMobile" class="form-label">Vehicle No</label>
                                    <input type="text" class="form-control" name="vehicle_no[]" disabled readonly>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3 data">
                                    <label for="inputMobile" class="form-label">Product</label>
                                    <input type="text" class="form-control" name="product_name[]" disabled  readonly>
                                </div>
                                <div class="col-md-3 data">
                                    <label for="inputMobile" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" name="quantity[]" disabled readonly>
                                </div>
                                <div class="col-md-3 data">
                                    <label for="inputMobile" class="form-label">Unit</label>
                                    <input type="text" class="form-control" name="unit[]" disabled readonly>
                                </div>
                                <div class="col-md-3"></div>
                                
    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Unloading Point</label>
                                        <input type="text" class="form-control" name="unloading_point[]" value="balasore" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="qty[]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" name="unloading_date[]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Challan Receiving Date</label>
                                        <input type="date" class="form-control" name="challan_receiving_date[]">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#previewModal">Preview</button>
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
                    <button type="button" class="btn btn-success mx-1" onclick="submit()">Save</button>
                    <button type="button" class="btn btn-danger mx-1" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    
    <script>
        var previewModal = document.getElementById('previewModal')
        previewModal.addEventListener('show.bs.modal', function (event) {
            $("select[name='loading_id_input']").val($("select[name='loading_id[]']").val())
            
    
            $("input[name='loading_date_input']").val($("input[name='loading_date[]']").val())
            $("input[name='broker_name_input']").val($("input[name='broker_name[]']").val())
            $("input[name='vehicle_no_input']").val($("input[name='vehicle_no[]']").val())
            $("input[name='product_name_input']").val($("input[name='product_name[]']").val())
            $("input[name='quantity_input']").val($("input[name='quantity[]']").val())
            $("input[name='unit_input']").val($("input[name='unit[]']").val())
            
            $("input[name='unloading_point_input']").val($("input[name='unloading_point[]']").val())
            $("input[name='qty_input']").val($("input[name='qty[]']").val())
            $("input[name='unloading_date_input']").val($("input[name='unloading_date[]']").val())
            $("input[name='challan_receiving_date_input']").val($("input[name='challan_receiving_date[]']").val())
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