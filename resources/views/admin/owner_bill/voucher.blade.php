<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Voucher</title>
    
    <style>
        table, tr, th, td {
            border: 1px solid black;
        }
    </style>
  </head>
  <body>
    
    <div class="container">
        <div class="row">
            <table class="table table-sm table-bordered">
                <tbody>
                    <tr>
                        <td colspan="5"><h1 class="text-center">APS Logistics</h1></td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="5" style="background-color: #BFBFBF;">Money Receipt For Owner Payment</td>
                    </tr>
                    <tr>
                        <td colspan="4" rowspan="2" class="text-center" style="vertical-align: middle;">
                            <h5>Owner Name - {{ $owner_name }}</h5>
                        </td>
                        <td class="text-center">Date- {{date('d-m-Y', strtotime($payment_date))}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">SL No. - {{$receipt}}	</td>
                    </tr>
                    <tr style="background-color: #BFBFBF;">
                        <th>SL No.</th>
                        <th>Brokar Name</th>
                        <th>Challan Date</th>
                        <th>Challan No</th>
                        <th class="text-center">Balance Payble</th>
                    </tr>
                    @foreach($loadings as $loading)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loading['broker_name'] }}</td>
                        <td>{{ date("d-m-Y", strtotime($loading['challan_date'])) }}</td>
                        <td>{{ $loading['challan_no'] }}</td>
                        <td class="text-center">{{ $loading['payble_balance'] }}</td>
                    </tr>
                    @endforeach
                    <tr style="background-color: #BFBFBF;">
                        <td colspan="4" class="text-start">Sub Total</td>
                        <td class="text-center">{{ $invoice_amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-start">Discount Received</td>
                        <td class="text-center">{{ $discount_amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-start">Tds Deduction</td>
                        <td class="text-center">{{ $tds_amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-start">Total Balance Payment</td>
                        <td class="text-center">{{ $payment_amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-start">Transaction ID</td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>