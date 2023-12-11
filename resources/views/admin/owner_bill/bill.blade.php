<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Form Style 1</title>

<style type="text/css">
.form-style-1 {
	margin:10px auto;
	max-width: 800px;
	padding: 20px 12px 10px 20px;
	font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	background-color: #ffffff;
}
.form-style-1 li {
	padding: 0;
	display: block;
	list-style: none;
	margin: 10px 0 0 0;
}
.form-style-1 label{
	margin:0 0 3px 0;
	padding:0px;
	display:block;
	font-weight: bold;
}
.form-style-1 input[type=text], 
.form-style-1 input[type=date],
.form-style-1 input[type=datetime],
.form-style-1 input[type=number],
.form-style-1 input[type=search],
.form-style-1 input[type=time],
.form-style-1 input[type=url],
.form-style-1 input[type=email],
textarea, 
select{
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	border:1px solid #BEBEBE;
	padding: 7px;
	margin:0px;
	-webkit-transition: all 0.30s ease-in-out;
	-moz-transition: all 0.30s ease-in-out;
	-ms-transition: all 0.30s ease-in-out;
	-o-transition: all 0.30s ease-in-out;
	outline: none;	
}
.form-style-1 input[type=text]:focus, 
.form-style-1 input[type=date]:focus,
.form-style-1 input[type=datetime]:focus,
.form-style-1 input[type=number]:focus,
.form-style-1 input[type=search]:focus,
.form-style-1 input[type=time]:focus,
.form-style-1 input[type=url]:focus,
.form-style-1 input[type=email]:focus,
.form-style-1 textarea:focus, 
.form-style-1 select:focus{
	-moz-box-shadow: 0 0 8px #88D5E9;
	-webkit-box-shadow: 0 0 8px #88D5E9;
	box-shadow: 0 0 8px #88D5E9;
	border: 1px solid #88D5E9;
}
.form-style-1 .field-divided{
	width: 49%;
}

.form-style-1 .field-long{
	width: 100%;
}
.form-style-1 .field-select{
	width: 100%;
}
.form-style-1 .field-textarea{
	height: 100px;
}
.form-style-1 input[type=submit], .form-style-1 input[type=button]{
	background: #4B99AD;
	padding: 8px 15px 8px 15px;
	border: none;
	color: #fff;
}
.form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover{
	background: #4691A4;
	box-shadow:none;
	-moz-box-shadow:none;
	-webkit-box-shadow:none;
}
.form-style-1 .required{
	color:red;
}
body {
	background-color: #FFFFFF;
}
table {
    border-collapse: collapse;
    width: 100%;
    
}

th, td {
    text-align: center;
    padding: 1px;
    font-size: 12px;
}

tr:hover {background-color: #f5f5f5}

th {
    background-color: white;
    color: black;
}

.style1 {
	color: #333333;
	font-weight: bold;
	font-size: 24px;
}
.style25 {color: #333333; font-weight: bold; font-size: 24px; }
.style24 {color: #333333; font-weight: bold; font-size: 20px; }

.stylee {
	color: #333333;
	font-weight: bold;
	font-size: 14px;
}
</style>
</head>
<body data-new-gr-c-s-check-loaded="14.1125.0" data-gr-ext-installed="">

<table border="1" cellpadding="4"> <!-- start the table, defining the table column headings -->

    <tbody><tr>
    <th class="style25">APS LOGISTICS</th>
        
         
         
    </tr> 
</tbody></table> <!-- end table -->
<table border="1" cellpadding="4"> <!-- start the table, defining the table column headings -->

    <tbody><tr>
    <th class="style24">Owner Payment Statement</th>
        
         
         
    </tr> 
</tbody></table> <!-- end table -->

<table border="1" cellpadding="4"> <!-- start the table, defining the table column headings -->
    <tbody>
        <tr>
            <th>Owner Payment Voucher No</th>
            <th>Owner Name</th>
            <th>Owner Billing Create Date</th>
            <th>Owner Bill Payment Date</th>
            <th>No Of Challan</th>
            <th>Payment Status</th>
        </tr>   
      
        <tr>
            <td>APSLEPOP23-24/210</td>
            <td>ABDUL HAMID SHA</td>
            <td>14-09-2023</td>
            <td>14-09-2023</td>
            <td>2</td>
            <td>Paid</td>
        </tr> 
    </tbody>
</table> <!-- end table -->

<table border="1" cellpadding="4"> <!-- start the table, defining the table column headings -->
    <tbody>
        <tr>
            <th>Sl No </th>
            <th>Challan Date</th>
            <th>Brokar Name</th>
            <th>Challan No</th>
            <th>Vehicle No</th>
            <th>Loading Qty</th>
            <th>Goods</th>
            <th>Price of Goods/MT</th>
            <th>Unloading Qty</th>
            <th>Unloading Date</th>
            <th>Unloading point</th>
            <th>Ch. Received Date</th>
            <th>Shortage</th>
            <th>Fright Amount</th>
            <th>Cash Advance</th>
            <th>Bank Advance</th>
            <th>Fuel Advance</th>
            <th>Brokar Commission</th>
            <th>Challan Commission</th>
            <th>Total Advance</th>
            <th>Balance</th>
            <th>Payble balance</th>
        </tr>   
        @foreach($records as $record)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('d-m-Y', strtotime($record->challan_date)) }}</td>
            <td>{{ $record->broker_name }}</td>
            <td>{{ $record->challan_no }}</td>
            <td>{{ $record->vehicle_no }}</td>
            <td>{{ $record->loading_qty }}</td>
            <td>{{ $record->product_name }}</td>
            <td>{{ number_format($record->broker_price, 2) }}</td>
            <td>{{ $record->unloading_qty }}</td>
            <td>{{ $record->unloading_date }}</td>
            <td>{{ $record->unloading_point }}</td>
            <td>{{ $record->challan_receiving_date }}</td>
            <td>Shortage</td>
            <td>Freight</td>
            <td>{{ number_format($record->cash_amount, 2) }}</td>
            <td>{{ number_format($record->bank_amount, 2) }}</td>
            <td>{{ number_format($record->fuel_amount, 2) }}</td>
            <td>{{ number_format($record->broker_commission, 2) }}</td>
            <td>100.00</td>
            <td>{{ number_format($record->total_advance, 2) }}</td>
            <td>{{ number_format($record->balance, 2) }}</td>
            <td>{{ number_format($record->payble_balance, 2) }}</td>
        </tr> 
        @endforeach

         <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>41.21</th>
            <th>41.21</th>
            <th>0</th>
            <th></th>
            <th>35539</th>
            <th>3000</th>
            <th>0</th>
            <th>26000</th>
            <th>29000</th>
            <th>0</th>
            <th>1200</th>
            <th>200</th>
            <th>200</th>
            <th>5139</th>
            <th>5000</th>
            <th></th>
        </tr>   
    </tbody>
</table>

<br><br><br>

<table border="0" cellpadding="4"> <!-- start the table, defining the table column headings -->
    <tbody>
        <tr>
            <th>Processed By</th>
            <th>Checked By</th>   
            <th>Passed By</th>
        </tr> 
    </tbody>
</table> 

<br><br>

<table border="0" align="left" cellpadding="4"> <!-- start the table, defining the table column headings -->
    <tbody>
        <tr>
            <td class="stylee">***If there is any complain related to this bill, you are requested to contact with our Durgachak office to resolve it within 10 days. After 10 days, no complaint regarding this bill will be entertained. </td>
        </tr>  
    </tbody>
</table> 


</body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration></html>