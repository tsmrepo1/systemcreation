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
                                <h5 class="mb-0 text-primary">Fuel Station List</h5>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL No.</th>
                                            <th scope="col">Fuel Station Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Contact No</th>
                                            <th scope="col">Opening Balance</th>
                                            <th scope="col">GST No</th>
                                            <th scope="col">PAN No</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col">Branch</th>
                                            <th scope="col">A/C No</th>
                                            <th scope="col">IFSC Code</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($stations))
                                        @foreach($stations as $station)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$station->fuel_station_name}}</td>
                                                <td>{{$station->email}}</td>
                                                <td>{{$station->address}}</td>
                                                <td>{{$station->contact_no}}</td>
                                                <td>{{$station->opening_balance}}</td>
                                                <td>{{$station->gst_no}}</td>
                                                <td>{{$station->pan}}</td>
                                                <td>{{$station->bank}}</td>
                                                <td>{{$station->branch}}</td>
                                                <td>{{$station->account_no}}</td>
                                                <td>{{$station->ifsc_code}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{route('fuel-stations.edit',$station->id)}}" class="btn btn-primary btn-sm mx-1">
                                                            <i class="fadeIn animated bx bx-edit"></i>
                                                        </a>
                                                        <form method="post" action="{{route('fuel-stations.destroy',$station->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="confirm('Are you sure to delete?')" class="btn btn-danger btn-sm">
                                                                <i class="fadeIn animated bx bx-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{-- <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        </li>
                                    </ul>
                                </nav> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>