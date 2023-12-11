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
                <div class="breadcrumb-title pe-3">Broker</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Entry</li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- Success and error messages start  --}}
            <br />
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            {{-- Success and error messages end  --}}

            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-1">
                <div class="col">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Payment Details</h5>
                            </div>
                            <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <form class="row g-3" method="POST" action="{{ route('broker.get_challan_by_date') }}">
                                            @csrf
                                                <div class="col-md-6">
                                                    <label class="form-label">Broker Name</label>
                                                    <select class="single-select" name="broker_id">
                                                        <option value="">--select--</option>
                                                        
                                                        @foreach($brokers as $broker)
                                                            <option value="{{ $broker->id }}" 
                                                            <?php if(isset($broker_id) && $broker_id == $broker->id) echo "selected";?>>{{ $broker->broker_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Payment Date</label>
                                                    <input type="date" class="form-control"  name="date" value="<?php if(isset($date)) echo $date ?>" />
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <button type="submit" class="btn btn-primary mt-4">View Challans</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            @if(isset($loadings) && count($loadings) > 0)
                                                <form class="row g-3" method="POST" action="{{ route('broker.payment.store') }}">
                                                @csrf
                                                    <h4>Total Amount: <span id="total_amount">0 INR</span></h4>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Payment Amount</label>
                                                        <input type="text" class="form-control"  name="payment_amount" />
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Discount</label>
                                                        <input type="text" class="form-control"  name="discount_received" />
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Balance</label>
                                                        <input type="text" class="form-control"  name="balance" />
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Narration</label>
                                                        <input type="text" class="form-control"  name="narration" />
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <input type="text" class="form-control d-none" name="broker_id" value="<?php if(isset($broker_id)) echo $broker_id; ?>" />
                                                        
                                                        <input type="text" class="form-control d-none" name="date" value="<?php if(isset($date)) echo $date; ?>" />
                                                        
                                                        <button type="submit" class="btn btn-primary px-5">Save</button>
                                                    </div>
                                                
                                                    <div class="row">
                                            @if(isset($loadings))
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Select</th>
                                                                <th>Date</th>
                                                                <th>Challan No</th>
                                                                <th>Vehicle</th>
                                                                <th>Commission</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($loadings as $loading)
                                                                <tr>
                                                                    <td>
                                                                        <input 
                                                                            type="checkbox" 
                                                                            class="form-check" 
                                                                            name="loading_id[]" 
                                                                            value="{{ $loading->id }}"
                                                                            data-amount="{{ $loading->broker_commission }}">
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($loading->date)) }}</td>
                                                                    <td>{{ $loading->challan_no }}</td>
                                                                    <td></td>
                                                                    <td>{{ $loading->broker_commission }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                            </form>
                                        @endif
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
        $("input:checkbox[name='loading_id[]']").on("change", function(event) {
            console.log("safsaf")
            let amount = 0
            $("input:checkbox[name='loading_id[]']:checked").each(function(){
                
                amount+=$(this).data("amount")
                $("#total_amount").text(`${amount} INR`)
                
                $("input[name='payment_amount']").val(amount)
            });
        })
    </script>
</x-app-layout>
