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

                                <h5 class="mb-0 text-primary">Running Overview</h5>

                            </div>

                            <hr>



                            <div class="table-responsive">

                                <table class="table table-sm table-bordered">

                                    <thead>

                                        <tr>
                                            <th scope="col">SL NO.</th>

                                            <th scope="col">Employee Name</th>

                                            <th scope="col">Assigned Project</th>

                                            <th scope="col">Running Project</th>

                                            <th scope="col">ACTION</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($records as $record)

                                        <tr>

                                            

                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $record['Name'] }}</td>

                                                <td>{{ $record['Assigned_Task'] }}</td=>

                                                <td>{{ $record['Running_Task'] }}</tde=>

                                                <td><button type="button" class="btn btn-primary" data-id="{{ $record['id'] }}">Show Details</button></td>

                                            </form>

                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>
                                <div class="modal fade" id="runningDetailsModal" tabindex="-1" role="dialog" aria-labelledby="runningDetailsLabel" aria-hidden="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="runningDetailsLabel">Running Tasks Details</h5>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>PROJECT ID</th>
              <th>TASK NAME</th>
              <th>PLANNED DATE</th>
              <th>FOR COMPANY</th>
            </tr>
          </thead>
          <tbody id="runningDetailsTable"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="close" data-dismiss="modal" onclick="closeAndResetRunningDetailsModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!--end page wrapper -->

    @include('inc.footer')



    <script>

$(function () {
  $('.btn-primary').click(function (e) {
    e.preventDefault();

    var id = $(this).data('id');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: "{{ route('running.details') }}", 
      method: 'post',
      dataType: 'json',
      data: {
        id: id
      },
      success: function (response) {
  var runningDetailsTable = $('#runningDetailsTable');

  // Loop through the data
  for (var i = 0; i < response.allrun.length; i++) {
    var itemData = response.allrun[i];

    // Create table row element
    var tableRow = $('<tr>');

    // Create and populate table cells
    var projid = $('<td>').text(itemData.tracking_id);
    var taskname = $('<td>').text(itemData.name);
    var planeddt = $('<td>').text(itemData.due);
    var company = $('<td>').text(itemData.for_company);

    // Append cells to the row
    tableRow.append(projid, taskname, planeddt,company);

    // Append the row to the table body
    runningDetailsTable.append(tableRow);
  }

  // Show the modal
  $('#runningDetailsModal').modal('show');
},
      error: function (error) {
        console.log(error);
        // Handle errors based on status code and response
      }
    });
  });
});
function closeAndResetRunningDetailsModal() {
  $('#runningDetailsModal').modal('hide');

  // Reset table body content
  $('#runningDetailsTable').empty();

  // Reset other elements if required (e.g., form fields)
}
    </script>

</x-app-layout>