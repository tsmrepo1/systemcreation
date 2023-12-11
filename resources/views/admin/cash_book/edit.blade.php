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
                <div class="breadcrumb-title pe-3">Edit Broker</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Broker</li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- Success and error messages start  --}}
            <br />
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            {{-- Success and error messages end  --}}

            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-1">
                <div class="col">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Edit Broker Details</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="POST" action="{{ route('brokers.update',$broker->id) }}" id="add-member-form">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <label for="inputMenberName" class="form-label">Broker's Name</label>
                                    <input type="text" class="form-control" value="{{ $broker->broker_name }}" name="broker_name" placeholder="Broker's Name">
                                    @error('broker_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputMenberName" class="form-label">Contact No</label>
                                    <input type="text" class="form-control" value="{{ $broker->contact_no }}" name="contact_no" placeholder="Contact No">
                                    @error('contact_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputMenberName" class="form-label">Email Id</label>
                                    <input type="email" class="form-control" value="{{ $broker->email }}" name="email" placeholder="Email Id">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputMenberName" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" value="{{ $broker->contact_person }}" name="contact_person" placeholder="Contact Person">
                                    @error('contact_person')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="inputMenberName" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" placeholder="Address">{{ $broker->address }}</textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputMenberName" class="form-label">Commission Payment Type</label>
                                    <select name="commission_payment_type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="per_trip" {{ $broker->commission_payment_type == 'per_trip' ? 'selected' : '' }}>Per Trip</option>
                                        <option value="monthly" {{ $broker->commission_payment_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    </select>
                                    @error('commission_payment_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputMenberName" class="form-label">GST No</label>
                                    <input type="text" class="form-control" value="{{ $broker->gst_no }}" name="gst_no" placeholder="GST No">
                                    @error('gst_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputMenberName" class="form-label">PAN</label>
                                    <input type="text" class="form-control" value="{{ $broker->pan }}" name="pan" placeholder="PAN">
                                    @error('pan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                
                                <div class="col-md-4">
                                    <label for="inputMenberName" class="form-label">Bank</label>
                                    <input type="text" class="form-control" value="{{ $broker->bank }}" name="bank" placeholder="Bank">
                                    @error('bank')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputMenberName" class="form-label">Branch</label>
                                    <input type="text" class="form-control" value="{{ $broker->branch }}" name="branch" placeholder="Branch">
                                    @error('branch')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputMenberName" class="form-label">Account No</label>
                                    <input type="text" class="form-control" value="{{ $broker->account_no }}" name="account_no" placeholder="Account No">
                                    @error('account_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="inputMenberName" class="form-label">IFSC Code</label>
                                    <input type="text" class="form-control" value="{{ $broker->ifsc_code }}" name="ifsc_code" placeholder="IFSC Code">
                                    @error('ifsc_code')
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script> --}}
</x-app-layout>
