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
                <div class="breadcrumb-title pe-3">Vehicle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Vehicle</li>
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
                                <h5 class="mb-0 text-primary">Add Vehicle Details</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="post" action="{{route('vehicles.store')}}" id="addVehicleForm">
                                @csrf
                                <div class="col-md-3">
                                    <label for="introducer_id" class="form-label">Vehicle No</label>
                                    <input type="text" class="form-control" id="vehicle_no" value="{{old('vehicle_no')}}" name="vehicle_no">
                                    @error('vehicle_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">PAN No</label>
                                    <input type="text" class="form-control" id="pan" value="{{old('pan')}}" name="pan" onkeyup="processChange()">
                                    @error('pan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="inputEmail" class="form-label">Owner's Name</label>
                                    <input type="text" class="form-control" id="owners_name" value="{{old('owners_name')}}" name="owners_name">
                                    @error('owners_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="inputDate" class="form-label">Contact No</label>
                                    <input type="text" class="form-control" id="contact_no" value="{{old('contact_no')}}" name="contact_no">
                                    @error('contact_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMobile" class="form-label">A/C No</label>
                                    <input type="text" class="form-control" id="account_no" value="{{old('account_no')}}" name="account_no">
                                    @error('account_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">IFSC Code</label>
                                    <input type="text" class="form-control" id="ifsc_code" value="{{old('ifsc_code')}}" name="ifsc_code">
                                    @error('ifsc_code')
                                        <span class="text-danger" id="ifsc_code_error">{{ $message }}</span>
                                    @enderror
                                </div>  
                                <div class="col-md-3">
                                    <label for="inputPanNumber" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" id="bank" value="{{old('bank')}}" name="bank" readonly>
                                    @error('bank')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">Branch Name</label>
                                    <input type="text" class="form-control" id="branch" value="{{old('branch')}}" name="branch" readonly>
                                    @error('branch')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">Fund Transfer Type</label>
                                    <select class="single-select" id="fund_transfer_type" name="fund_transfer_type">
                                        <option value=""
                                                {{old('fund_transfer_type' == "" ? "selected" : "")}}>--select--</option>
                                        
                                        <option value="NEFT" 
                                                 {{old('fund_transfer_type' == "NEFT" ? "selected" : "")}}>NEFT</option>
                                        
                                        <option value="RTGS" 
                                                {{old('fund_transfer_type' == "RTGS" ? "selected" : "")}}>RTGS</option>
                                                
                                        <option value="IMPS"
                                                {{old('fund_transfer_type' == "IMPS" ? "selected" : "")}}>IMPS</option>
                                                
                                        <option value="Phone Pay"
                                                {{old('fund_transfer_type' == "Phone Pay" ? "selected" : "")}}>Phone Pay</option>
                                        
                                        <option value="Google Pay"
                                                {{old('fund_transfer_type' == "Google Pay" ? "selected" : "")}}>Google Pay</option>
                                        
                                        <option value="Paytm"
                                                {{old('fund_transfer_type' == "Paytm" ? "selected" : "")}}>Paytm</option>
                                        
                                        <option value="UPI"
                                                {{old('fund_transfer_type' == "UPI" ? "selected" : "")}}>UPI</option>
                                                
                                        <option value=""
                                            {{old('fund_transfer_type' == "" ? "selected" : "")}}>NA</option>
                                    </select>
                                    @error('fund_transfer_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>  
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    @include('inc.footer')
    
    <script>
        function debounce(func, timeout = 400){
        let timer;
          return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => { func.apply(this, args); }, timeout);
          };
        }
        
        function getDetails(){
            let pan = document.getElementById("pan").value;
            
            fetch(`{{ url('/vehicles/search') }}/${pan}`)
            .then(response => response.json())
            .then(data => {
              if(data.vehicle) {
                  document.getElementById("owners_name").value          = data.vehicle.owners_name
                  document.getElementById("contact_no").value           = data.vehicle.contact_no
                  document.getElementById("bank").value                 = data.vehicle.bank
                  document.getElementById("account_no").value           = data.vehicle.account_no
                  document.getElementById("branch").value               = data.vehicle.branch
                  document.getElementById("ifsc_code").value            = data.vehicle.ifsc_code
                  document.getElementById("fund_transfer_type").value   = data.vehicle.fund_transfer_type
              }
              else {
                  document.getElementById("owners_name").value          = ""
                  document.getElementById("contact_no").value           = ""
                  document.getElementById("bank").value                 = ""
                  document.getElementById("account_no").value           = ""
                  document.getElementById("branch").value               = ""
                  document.getElementById("ifsc_code").value            = ""
                  document.getElementById("fund_transfer_type").value   = ""
              }
            })
        }
        
        const processChange = debounce(() => getDetails());
    </script>
</x-app-layout>


