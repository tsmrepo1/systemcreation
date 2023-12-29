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
                <div class="breadcrumb-title pe-3">Edit Client</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Client</li>
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
                                <h5 class="mb-0 text-primary">Edit Client Details</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="POST" action="{{ route('clients.update',$client->id) }}" id="add-member-form">
                                @csrf
                                @method('PUT')
                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">Client's Name</label>
                                    <input type="text" class="form-control" value="{{$client->client_name}}" name="client_name">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">Contact No</label>
                                    <input type="text" class="form-control" value="{{$client->contact_no}}" name="contact_no">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">Email Id</label>
                                    <input type="email" class="form-control" value="{{$client->email}}" name="email">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" value="{{$client->contact_person}}" name="contact_person">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">Address</label>
                                    <textarea class="form-control" name="address">{{$client->address}}</textarea>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">Opening Balance</label>
                                    <input type="text" class="form-control" value="{{$client->opening_balance}}" name="opening_balance">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">GST No</label>
                                    <input type="text" class="form-control" value="{{$client->gst_no}}" name="gst_no">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">PAN</label>
                                    <input type="text" class="form-control" value="{{$client->pan}}" name="pan">
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
