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

                <div class="breadcrumb-title pe-3">Task</div>

                <div class="ps-3">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb mb-0 p-0">

                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>

                            <li class="breadcrumb-item active" aria-current="page">My Task</li>

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

                                <h5 class="mb-0 text-primary">Tasks</h5>

                            </div>

                            <hr>



                            <div class="table-responsive">

                                <table class="table table-sm table-bordered">

                                    <thead>

                                        <tr>

                                            <th scope="col">SL NO.</th>

                                            <th scope="col">PROJECT ID</th>

                                            <th scope="col">TASK NAME</th>

                                            <th scope="col">DESCRIPTION</th>

                                            <th scope="col">PRIORITY</th>

                                            <th scope="col">PLANNED DATE</th>

                                            <th scope="col">FOR COMPANY</th>

                                            <th scope="col">Assigned By</th>

                                            <th scope="col">STATUS</th>

                                            <th scope="col">ACTION</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($records as $record)

                                        <tr>

                                            <form id="{{$record->id}}" action="{{ route('employeetasks.update', $record->id) }}" method="POST">

                                                @method("PUT")

                                                @csrf

                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $record->tracking_id }}</td>

                                                <td>{{ $record->task->name }}</td=>

                                                <td>{{ $record->task->description }}</tde=>

                                                <td></td>

                                                <td>{{ $record->due }}</td>
                                                <td>{{ $record->task->for_company }}</td>

                                                <td>{{ $record->task->Naam }}</td>

                                                <td>

                                                    <select class="form-select form-select-sm" name="status">

                                                        <option value="FULLY COMPLETED" <?php echo $record->status == "FULLY COMPLETED" ? "selected" : "" ?>>Fully Completed</option>

                                                        <option value="PARTIALLY COMPLETED" <?php echo $record->status == "PARTIALLY COMPLETED" ? "selected" : "" ?>>Partially Completed</option>

                                                        <option value="IN PROGRESS" <?php echo $record->status == "IN PROGRESS" ? "selected" : "" ?>>In Progress</option>

                                                        <option value="ON HOLD" <?php echo $record->status == "ON HOLD" ? "selected" : "" ?>>On Hold</option>

                                                        <option value="NA" <?php echo $record->status == "NA" ? "selected" : "" ?>>NA</option>



                                                        @if($record->status == "PENDING")

                                                        <option value="PENDING" <?php echo $record->status == "PENDING" ? "selected" : "" ?>>Pending</option>

                                                        @endif

                                                    </select>

                                                </td>

                                                <td>

                                                    @if($record->status != "FULLY COMPLETED")

                                                    <button class="btn btn-sm btn-primary">Save</button>

                                                    @endif

                                                </td>

                                            </form>

                                        </tr>

                                        @endforeach

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

</x-app-layout>