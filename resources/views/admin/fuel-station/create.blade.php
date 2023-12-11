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
                <div class="breadcrumb-title pe-3">Fuel Station</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Fuel Station</li>
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
                                <h5 class="mb-0 text-primary">Add Fuel Station Details</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="POST" action="{{ route('fuel-stations.store') }}" id="add-member-form">
                                @csrf
                                <div class="col-md-3">
                                    <label for="introducer_id" class="form-label">Fuel Station Name</label>
                                    <input type="text" class="form-control" value="{{old('fuel_station_name')}}" name="fuel_station_name">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{old('email')}}" name="email">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputEmail" class="form-label">Contact No</label>
                                    <input type="text" class="form-control" value="{{old('contact_no')}}" name="contact_no">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputDate" class="form-label">Opening Balance</label>
                                    <input type="text" class="form-control" value="{{old('opening_balance')}}" name="opening_balance">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputMobile" class="form-label">GST No</label>
                                    <input type="text" class="form-control" value="{{old('gst_no')}}" name="gst_no">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">PAN No</label>
                                    <input type="text" class="form-control" value="{{old('pan')}}" name="pan">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword" class="form-label">Address</label>
                                    <input type="text" class="form-control" value="{{old('address')}}" name="address">
                                </div>    
                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">Account No</label>
                                    <input type="text" class="form-control" value="{{old('account_no')}}" name="account_no">
                                </div>      
                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">IFSC Code</label>
                                    <input type="text" class="form-control" id="ifsc_code" value="{{old('ifsc_code')}}" name="ifsc_code">
                                </div>    
                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">Bank</label>
                                    <input type="text" class="form-control" id="bank" value="{{old('bank')}}" name="bank" readonly>
                                </div>         
                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">Branch</label>
                                    <input type="text" class="form-control" id="branch" value="{{old('branch')}}" name="branch" readonly>
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
</x-app-layout>