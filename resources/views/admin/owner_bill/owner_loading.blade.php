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
                <div class="breadcrumb-title pe-3">Create Owner Bill</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Owner Bill</li>
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
                                <h5 class="mb-0 text-primary">Create Owner Bill</h5>
                            </div>
                            <hr>
                            
                            <h5>Total Payble Amount: <span id="total_payble_amount">0 INR</span></h5>
                            <form class="row g-3" method="POST" action="{{ route('owner_bill.store') }}">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="table-dark text-light">
                                                <th>SL No.</th>
                                                <th>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="" id="selectAll">
                                                      <label class="form-check-label" for="flexCheckDefault">
                                                       Select All
                                                      </label>
                                                    </div>
                                                </th>
                                                <th>Challan Date</th>
                                                <th>Vehicle No</th>
                                                <th>Challan No</th>
                                                <th>Product Name</th>
                                                <th>Price Of Product/MT</th>
                                                <th>Loading Qty</th>
                                                <th>Unloading Qty</th>
                                                <th>Unloading Point</th>
                                                <th>Unloading Date</th>
                                                <th>Shortage</th>
                                                <th>Total Frieght</th>
                                                <th>Cash Advance</th>
                                                <th>Bank Advance</th>
                                                <th>Fuel Advance</th>
                                                <th>Broker Commission</th>
                                                <th>Challan Commission</th>
                                                <th>Total Advance</th>
                                                <th>Balance</th>
                                                <th>Payble Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 0 @endphp
                                            @foreach($records as $record) @php $i++ @endphp
                                               <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        <div class="form-check">
                                                          <input 
                                                            class="form-check-input" 
                                                            type="checkbox" 
                                                            name="unloading[]" 
                                                            value="{{ $record['unloading_id'] }}"
                                                            data-payble_balance="{{ $record['payble_balance'] }}">
                                                        </div>
                                                    </td>
                                                    <td>{{ $record["challan_date"] }}</td>
                                                    <td>{{ $record['vehicle_no'] }}</td>
                                                    <td>{{ $record['challan_no'] }}</td>
                                                    <td>{{ $record['product_name'] }}</td>
                                                    <td>{{ $record['price'] }}</td>
                                                    <td>{{ $record['loading_qty'] }}</td>
                                                    <td>{{ $record['unloading_qty'] }}</td>
                                                    <td>{{ $record['unloading_point'] }}</td>
                                                    <td>{{ $record['unloading_date'] }}</td>
                                                    <td>{{ $record['shortage'] }}</td>
                                                    <td>{{ $record['total_frieght'] }}</td>
                                                    <td>{{ $record['cash_advance'] }}</td>
                                                    <td>{{ $record['bank_advance'] }}</td>
                                                    <td>{{ $record['fuel_advance'] }}</td>
                                                    <td>{{ $record['broker_commission'] }}</td>
                                                    <td>{{ $record['challan_commission'] }}</td>
                                                    <td>{{ $record['total_advance'] }}</td>
                                                    <td>{{ $record['balance'] }}</td>
                                                    <td>{{ $record['payble_balance'] }}</td>
                                               </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    
    <script>
        function calculate_total_payble_amount() {
            let total_payble_amount = 0
            
            $("input[name='unloading[]']:checked").each(function() {
                total_payble_amount += $(this).data("payble_balance")
            })    
            
            $("#total_payble_amount").text(total_payble_amount + " INR")
        }
        
        $("#selectAll").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            calculate_total_payble_amount()
        });
        
        $("input[name='unloading[]']").on("change", function(){
            calculate_total_payble_amount()
        })
    </script>
    @include('inc.footer')
</x-app-layout>
