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
                <div class="breadcrumb-title pe-3">Cash Book</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ledger</li>
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
                                <h5 class="mb-0 text-primary">Ledger</h5>
                            </div>
                            <hr>
                            
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Particulars</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $record)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $record['date'] }}</td>
                                                <td>{{ $record['particulars'] }}</td>
                                                <td>{{ $record['debit'] }}</td>
                                                <td>{{ $record['credit'] }}</td>
                                                <td>{{ $record['balance'] }}</td>
                                                <td>
                                                    @if($record["type"] == "Loading")
                                                        <button 
                                                            class="btn btn-sm btn-dark detail" 
                                                            data-loadings="{{ $record['loadings'] }}"
                                                            data-for="{{ $record['for'] }}">See Details</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-dark text-white">
                                            <td colspan="3">Closing Balance</td>
                                            <td>{{ $debit }}</td>
                                            <td>{{ $credit }}</td>
                                            <td>{{ $balance }}</td>
                                            <td></td>
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
    
    <!-- The Modal -->
    <div class="modal fade" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Record</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Challan Date</th>
                                <th>Vehicle No</th>
                                <th>Challan No</th>
                                <th id="module_name"></th>
                                <th>Broker Name</th>
                            </tr>
                        </thead>
                        <tbody id="detail_record"></tbody>
                    </table>
                </div>
            </div>
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    
    <!--end page wrapper -->
    @include('inc.footer')
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script> --}}
    
    <script>
        $(document).ready(function() {
            var modal = new bootstrap.Modal(document.getElementById('previewModal'), {
              keyboard: false
            })
            
            $(".detail").on("click", function(event) {
                let loadings = $(this).data("loadings")
                let module = $(this).data("for")
                
                $("#module_name").empty()
                $("#detail_record").empty()
                
                
                fetch("{{ route('loadings.detail') }}", {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    method: "POST",
                    body: JSON.stringify({loadings, module})
                })
                .then(response => response.json())
                .then(data => {
                    $("#module_name").text(data.module)
                    
                    data.records.forEach(function(record, index) {
                        $("#detail_record").append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${record.date}</td>
                                <td>${record.vehicle_no}</td>
                                <td>${record.challan_no}</td>
                                <td>${record.amount}</td>
                                <td>${record.broker_name}</td>
                            </tr>
                        `)  
                        
                    })
                    
                    modal.show()
                })
                .catch(error => console.log(error))
            })
        })

    </script>
</x-app-layout>
