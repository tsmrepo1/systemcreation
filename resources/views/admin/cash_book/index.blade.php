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
                <div class="breadcrumb-title pe-3">Cash Book</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cash Book</li>
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
                                <h5 class="mb-0 text-primary">Cash Book</h5>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr class="table table-dark text-light">
                                            <th scope="col">SL No.</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Cashier Name</th>
                                            <th scope="col">Transaction Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Narration</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($cashbook as $record) @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{ date("d-m-Y", strtotime($record->date))}}</td>
                                                <td>{{$record->cashier->cashier_name}}</td>
                                                <td>{{$record->transaction_type}}</td>
                                                <td>{{$record->amount}}</td>
                                                <td>{{$record->narration}}</td>
                                                <td class="text-end">
                                                    <div class="btn-group">
                                                        <a href="{{route('cashbook.edit',$record->id)}}" class="btn btn-primary btn-sm mx-1">Edit</a>
                                                        <form method="post" action="{{route('cashbook.destroy',$record->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="confirm('Are you sure to delete?')" class="btn btn-danger btn-sm mx-1">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    
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