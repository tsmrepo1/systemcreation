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
                <div class="breadcrumb-title pe-3">EM Score</div>
            </div>
            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-1">
                <div class="col">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title align-items-center">
                                <div class="row">
                                    <div class="col-6 text-start">
                                        <h3 class="mb-0 text-primary">EM Score</h3>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h2 class="mb-0 text-dark" id="LL">Final Score: {{ ($records['score_Cl'] + $records['score_Dl'])/2  }}%</h2>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container text-center mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="startDate" class="form-label">Start Date:</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="startDate" name="startDate" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="endDate" class="form-label">End Date:</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="endDate" name="endDate" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary mt-3" id="searchButton">Search</button>
                            </div>
                            <div class="table-responsive" id="pre">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Source</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Completed</th>
                                            <th scope="col">Delayed</th>
                                            <th scope="col">Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Checklist</strong></td>
                                            <td>{{ $records['total_Cl_Alloted'] }}</td>
                                            <td>{{ $records['total_Cl_Completed'] }}</td>
                                            <td>{{ $records['total_delay_Cl'] }}</td>
                                            <td>{{ $records['score_Cl'] . '%' }}</td>
                                        </tr>

                                        <tr>
                                            <td><strong>Delegation</strong></td>
                                            <td>{{ $records['total_Dl_Alloted'] }}</td>
                                            <td>{{ $records['total_Dl_Completed'] }}</td>
                                            <td>{{ $records['total_delay_Dl'] }}</td>
                                            <td>{{ $records['score_Dl']  . '%' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive" id="scnd" style="display: none;">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Source</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Completed</th>
                                            <th scope="col">Delayed</th>
                                            <th scope="col">Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Checklist</strong></td>
                                            <td id="a"></td>
                                            <td id="b"></td>
                                            <td id="c"></td>
                                            <td id="d"></td>

                                        </tr>

                                        <tr>
                                            <td><strong>Delegation</strong></td>
                                            <td id="e"></td>
                                            <td id="f"></td>
                                            <td id="g"></td>
                                            <td id="h"></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    @include('inc.footer')

    <!-- <script>
        $("form").on("submit", function(event) {
            event.preventDefault()

            fetch(event.target.action, {
                headers: {
                    "X-CSRF-Token": $('input[name="_token"]').val()
                },
                method: "PUT",
                body: new FormData(document.getElementById(event.target.id))
            })
            .then(response => response.json())
            .then(data => console.log())
        })
    </script> -->
    <script>
        $(document).ready(function() {
            // $('#startDate, #endDate').datepicker({
            //     format: 'yyyy-mm-dd',
            //     autoclose: true,
            //     todayHighlight: true
            // });

            // AJAX call on search button click
            $('#searchButton').on('click', function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                // Perform AJAX call with selected date range
                $.ajax({
                    url: "{{ route('datewise.emscore') }}", // Make sure this route name is correct
                    method: 'POST', // or 'GET' depending on your backend route
                    data: {
                        startDate: startDate,
                        endDate: endDate,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#pre').hide();
                        $('#scnd').show();
                        $('#a').text(data.message.total_Cl_Alloted);
                        $('#b').text(data.message.total_Cl_Completed);
                        $('#c').text(data.message.total_Pending_Cl);
                        $('#d').text(data.message.score_Cl);
                        $('#e').text(data.message.total_Dl_Alloted);
                        $('#f').text(data.message.total_Dl_Completed);
                        $('#g').text(data.message.total_Pending_Dl);
                        $('#h').text(data.message.score_Dl);
                        $('#LL').text("Final Score:"+(data.message.score_Cl+data.message.score_Dl)/2);

                    },
                    error: function(error) {
                        // Handle the error response
                        console.error('Error:', error);
                    }
                });
            });

        });
    </script>
</x-app-layout>