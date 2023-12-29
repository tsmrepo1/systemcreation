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
            <div class="dash-wrapper bg-dark">
                <!-- Full-width row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card-body text-center">
                                <p class="mb-1 text-white">My EM Score</p>
                                <h3 class="mb-3 text-white">{{ ($records['score_Cl'] + $records['score_Dl'])/2 }} %</h3>
                                <a class="text-white" href="{{route('emscore')}}">View Details</a>
                                @if((auth()->user()->role == 1)||(auth()->user()->role == 2))
                                <!-- Full-width table -->
                                <table class="table table-sm table-bordered" style="width: 100%;color:white">

                                    <thead>

                                        <tr>

                                            <th scope="col">SL NO.</th>

                                            <th scope="col">PROJECT ID</th>

                                            <th scope="col">TASK NAME</th>

                                            <th scope="col">DESCRIPTION</th>

                                            <th scope="col">PLANNED DATE</th>

                                            <th scope="col">FOR COMPANY</th>

                                            <th scope="col">Assigned By</th>

                                            <th scope="col">Assigned To</th>

                                            <th scope="col">Assigned on</th>

                                            <th scope="col">STATUS</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        @foreach($records['taskdet'] as $vll)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $vll->tracking_id }}</td>
                                                <td>{{ $vll->name }}</td>
                                                <td>{{ $vll->description }}</td>
                                                <td>{{ $vll->due }}</td>
                                                <td>{{ $vll->for_company }}</td>
                                                <td>{{ $vll->assigner }}</td>
                                                <td>{{ $vll->doer }}</td>
                                                <td>{{ $vll->assigned_date }}</td>
                                                <td>{{ $vll->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end page wrapper -->

    @include('inc.footer')

</x-app-layout>
