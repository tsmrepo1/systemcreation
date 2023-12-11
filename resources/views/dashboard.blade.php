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
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-cols-xxl-5">
                    <div class="col border-end border-light-2">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card-body text-center">
                                <p class="mb-1 text-white">My EM Score</p>
                                <h3 class="mb-3 text-white">{{ ($records['score_Cl'] + $records['score_Dl'])/2 }} %</h3>
                                <a class="text-white" href="{{route('emscore')}}">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end page wrapper -->

    <script src="{{ asset('public/assets/plugins/highcharts/js/highcharts.js') }} "></script>
    <script src="{{ asset('public/assets/plugins/highcharts/js/exporting.js') }} "></script>
    <script src="{{ asset('public/assets/plugins/highcharts/js/variable-pie.js') }} "></script>
    <script src="{{ asset('public/assets/plugins/highcharts/js/export-data.js') }} "></script>
    <script src="{{ asset('public/assets/plugins/highcharts/js/accessibility.js') }} "></script>
    <script src="{{ asset('public/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }} "></script>


    @include('inc.footer')

</x-app-layout>