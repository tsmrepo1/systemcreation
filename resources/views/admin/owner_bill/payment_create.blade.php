<x-app-layout>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.css"> --}}
    <!--sidebar wrapper -->
    @include('inc.sidebar')
    <!--end sidebar wrapper -->

    <!--start header -->
    @include('inc.header')
    <!--end header -->

    <style>
        form input {
            width: 200px !important;
        }
        form select {
            width: 200px !important;
        }
    </style>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Payment Entry</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Entry</li>
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
                                <h5 class="mb-0 text-primary">Payment Entry</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="POST" action="{{ route('owner_bill.get_owner_name') }}" id="add-member-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" name="date" required  value="<?php echo isset($date) ? $date : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Get Bill</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    @if(isset($records))
                     <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Bills</h5>
                            </div>
                            <hr>
                            @if(count($records) > 0)
                                <form class="row g-3" method="POST" action="{{ route('owner_bill.store_payment') }}" id="add-member-form">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SL NO.</th>
                                                <th></th>
                                                <th>Owner Name</th>
                                                <th>No. of Invoice</th>
                                                <th>Invoice Amount</th>
                                                <th>Receipt Type</th>
                                                <th>Payment Mode</th>
                                                <th>Payment Amount</th>
                                                <th>TDS Deduction</th>
                                                <th>Discount Recieved</th>
                                                <th>Balance</th>
                                                <th>Narration</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            @foreach($records as $record)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <button 
                                                        type="button"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#previewModal"
                                                        data-bill_id="{{ $record['bills'] }}" 
                                                        class="btn btn-sm btn-dark previewModal">Invoice & Challan</button>
                                                </td>
                                                <td>
                                                    <input 
                                                        type="text" 
                                                        class="form-control d-none" 
                                                        name="owner_bills[]" 
                                                        value="{{ $record['bills'] }}" />
                                                        
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        name="owner_name[]" 
                                                        value="{{ $record['owner_name'] }}" readonly required/>
                                                </td>
                                                <td>
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        value="{{ $record['total_number_of_bills'] }}" readonly required/>
                                                </td>
                                                <td>
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        name="invoice_amount[]" 
                                                        value="{{ $record['payble_balance'] }}" readonly required/>
                                                </td>
                                                <td>
                                                    <select class="form-select" name="receipt_type[]" required>
                                                        <option value="">--select--</option>
                                                        <option value="ON ACCOUNT">On Account</option>
                                                        <option value="BILL TO BILL">Bill To Bill</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select" name="payment_mode[]" required>  	
                                                        <option value="">--select--</option>	
                                                        <option value="Cash">Cash</option>
                    									<option value="NEFT">NEFT</option>
                    									<option value="RTGS">RTGS</option>
                    									<option value="IMPS">IMPS</option>
                    									<option value="UPI">UPI</option>
                    									<option value="Cheque">Cheque</option>
            								        </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="payment_amount[]" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="tds_deduction[]" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="discount_received[]" required>
                                                </td>
                                                <td>
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        name="balance[]" 
                                                        value="{{ $record['payble_balance'] }}" required readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="narration[]" required>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </thead>
                                    </table>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                            @else
                                <h5 class="text-center text-muted">No Records Found</h5>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- The View Modal -->
    <div class="modal fade" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Invoice Record</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>SL NO</th>
                            <th>INVOICE DATE</th>
                            <th>INVOICE NO</th>
                            <th>CHALLAN NO</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    
    <script>
        $("input[name='date']").on("change", function() {
            let date = $("input[name='date']").val()
            
            $("select[name='owner_name']").empty()
            
            fetch(`{{ url('owner_bill/bill/') }}/${date}`)
            .then(response => response.json())
            .then(data => {
                
                $("select[name='owner_name']").append("<option value=''>--select--</option>")
                
                data.owners.forEach((element, index) => {
                   $("select[name='owner_name']").append(`<option value='${element.owners_name}'>${element.owners_name}</option>`) 
                })
            })
            .catch(error => console.log(err))
        })
        
        $("input[name='payment_amount[]']").on("change", function() {
            let element = $(this).parent().parent()
            
            let invoice_amount      = element.find("input[name='invoice_amount[]']").val()
            
            let payble_amount       = element.find("input[name='payment_amount[]']").val()
            let tds_deduction       = element.find("input[name='tds_deduction[]']").val()
            let discount_received   = element.find("input[name='discount_received[]']").val()
            
            invoice_amount = invoice_amount == "" ? 0 : Number(invoice_amount)
            
            payble_amount       = payble_amount == "" ? 0 : Number(payble_amount)
            tds_deduction       = tds_deduction == "" ? 0 : Number(tds_deduction)
            discount_received   = discount_received == "" ? 0 : Number(discount_received)
            
            let balance = invoice_amount - (payble_amount + tds_deduction + discount_received)
            element.find("input[name='balance[]']").val(balance)
        })
        
        $("input[name='tds_deduction[]']").on("change", function() {
            let element = $(this).parent().parent()
            
            let invoice_amount      = element.find("input[name='invoice_amount[]']").val()
            
            let payble_amount       = element.find("input[name='payment_amount[]']").val()
            let tds_deduction       = element.find("input[name='tds_deduction[]']").val()
            let discount_received   = element.find("input[name='discount_received[]']").val()
            
            invoice_amount = invoice_amount == "" ? 0 : Number(invoice_amount)
            
            payble_amount       = payble_amount == "" ? 0 : Number(payble_amount)
            tds_deduction       = tds_deduction == "" ? 0 : Number(tds_deduction)
            discount_received   = discount_received == "" ? 0 : Number(discount_received)
            
            let balance = invoice_amount - (payble_amount + tds_deduction + discount_received)
            element.find("input[name='balance[]']").val(balance)
        })
        
        
        $("input[name='discount_received[]']").on("change", function() {
            let element = $(this).parent().parent()
            
            let invoice_amount      = element.find("input[name='invoice_amount[]']").val()
            
            let payble_amount       = element.find("input[name='payment_amount[]']").val()
            let tds_deduction       = element.find("input[name='tds_deduction[]']").val()
            let discount_received   = element.find("input[name='discount_received[]']").val()
            
            invoice_amount = invoice_amount == "" ? 0 : Number(invoice_amount)
            
            payble_amount       = payble_amount == "" ? 0 : Number(payble_amount)
            tds_deduction       = tds_deduction == "" ? 0 : Number(tds_deduction)
            discount_received   = discount_received == "" ? 0 : Number(discount_received)
            
            let balance = invoice_amount - (payble_amount + tds_deduction + discount_received)
            element.find("input[name='balance[]']").val(balance)
        })
    </script>
    
    <script>
        $(".previewModal").on("click", function() {
            let bill_id = $(this).data("bill_id")
            
            $("#previewModal .modal-body table tbody").empty()
            fetch(`{{url('owner_bill/invoice/')}}/${bill_id}`)
            .then(response => response.json())
            .then(data => {
                let html = ""
                
                data.forEach((record, idx) => {
        
                    let numberOfChallans = record.challans.length
                    
                    record.challans.forEach((challan, index) => {
                        if(index == 0) {
                            html = html + `<tr> 
                                        <td rowspan='${numberOfChallans}' style="text-align: center; vertical-align: middle;">${idx + 1}</td> 
                                        <td rowspan='${numberOfChallans}' style="text-align: center; vertical-align: middle;"><?php echo isset($date) ? date('d-m-Y', strtotime($date)) : '' ?></td> 
                                        <td rowspan='${numberOfChallans}' style="text-align: center; vertical-align: middle;">${record.invoice}</td>
                                        <td>${challan}</td>
                                    </tr>`;
                        }
                        else {
                            html = html + `<tr> <td>${challan}</td> </tr>`;
                        }
                    })

                })

                $("#previewModal .modal-body table tbody").append(html)
            })
            .catch(console.log)
        })
    </script>
    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>
