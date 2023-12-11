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

                            <li class="breadcrumb-item active" aria-current="page">Create Task</li>

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

                                <h5 class="mb-0 text-primary">Add New Task</h5>

                            </div>

                            <hr>



                            <form action="{{ route('mastertasks.store') }}" method="POST">

                                @csrf

                                <div class="row">

                                    <div class="col-md-8">

                                        <div class="form-group mb-3">

                                            <label class="form-label">Task name</label>

                                            <input class="form-control" type="text" name="name" required>

                                        </div>



                                        <div class="form-group mb-3">

                                            <label class="form-label">Description</label>

                                            <textarea class="form-control" name="description" required></textarea>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group mb-3">

                                            <label class="form-label">Due date</label>

                                            <input class="form-control" type="date" name="due" required>

                                        </div>
                                        <div class="mb-3">
    <label for="assigned_to" class="form-label">Company Name</label>
    <select class="form-select" aria-label="Default select example" name="for_company">
        <option value="" disabled selected>-- Select --</option>
        <option value="tsm">TSM</option>
        <option value="xyz">XYZ</option>
        <option value="abc">ABC</option>
    </select>
</div>
<?php $currentDate = now()->format('Y-m-d'); ?>
                                        

                                        <div class="form-group mb-3">

                                            <label class="form-label">Assign date</label>

                                            <input class="form-control" type="date" value="{{ $currentDate }}" name="assigned_date" required>

                                        </div>



                                        <div class="form-group mb-3">

                                            <label class="form-label">Frequency</label>

                                            <select class="form-control" name="frequency" required>

                                                <option value="">select</option>

                                                <option value="ONE TIME">One Time</option>

                                                <option value="DAILY">Daily</option>

                                                <option value="WEEKLY">Weekly</option>

                                                <option value="FORTHNIGHT">Forthnight</option>

                                                <option value="MONTHLY">Monthly</option>

                                            </select>

                                        </div>



                                        <div class="form-group mb-3">

                                            <label class="form-label">Assigned by</label>

                                            <select class="form-control" name="assigned_by" required>

                                                <option value="">select</option>

                                                @foreach($super_admins as $user)

                                                <option value="{{ $user->id }}">{{ $user->name }}</option>

                                                @endforeach

                                            </select>

                                        </div>



                                        <div class="form-group mb-3">

                                            <label class="form-label">Assigned type</label>

                                            <select class="form-control" name="assigned_to" required>

                                                <option value="">select</option>

                                                <option value="TEAM">Team</option>

                                                <option value="INDIVIDUAL">Individual</option>

                                            </select>

                                        </div>



                                        <div class="form-group mb-3" id="assign_to" style="display: none;">

                                            <label class="form-label">Assigned to</label>

                                            <select class="form-control" name="assigned_team_id[]" style="display: none;" multiple>

                                                @foreach($teams as $team)

                                                <option value="{{ $team->id }}">{{ $team->name }}</option>

                                                @endforeach

                                            </select>



                                            <select class="form-control" name="assigned_individual_id[]" style="display: none;" multiple>

                                                @foreach($users as $user)

                                                <option value="{{ $user->id }}">{{ $user->name }}</option>

                                                @endforeach

                                            </select>

                                        </div>



                                    </div>

                                </div>



                                <button class="btn btn-primary">Save</button>

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

        $("select[name='assigned_to']").on("change", function() {

            if ($("select[name='assigned_to']").val() == "TEAM") {

                $("#assign_to").css("display", "block")

                $("select[name='assigned_team_id[]']").css("display", "block")

                $("select[name='assigned_individual_id[]']").css("display", "none")

            } else if ($("select[name='assigned_to']").val() == "INDIVIDUAL") {

                $("#assign_to").css("display", "block")

                $("select[name='assigned_team_id[]']").css("display", "none")

                $("select[name='assigned_individual_id[]']").css("display", "block")

            } else {

                $("#assign_to").css("display", "none")

                $("select[name='assigned_team_id[]']").css("display", "none")

                $("select[name='assigned_individual_id[]']").css("display", "none")

            }

        })

    </script>

</x-app-layout>