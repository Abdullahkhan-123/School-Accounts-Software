<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
.container{
    width: 750px;
    margin:auto;
    padding:50px;
}

/* General styles */
 table {
    width: 100%;
    height: auto;
    background-color: #fff;
    padding: 20px;
    font-size: 12px;
    border: 1px solid #ebebeb;
    border-top: 0;
}

/* Print-specific styles */
@media print {
    body {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .invoice-container {
        width: 100% !important;
    }

    thead {
        background: #fafafa !important;
    }

    tbody {
        background: #ffff !important;
        padding: 20px !important;
    }

    .highlight {
        background: #fafafa !important;
        padding: 10px !important;
        text-align: center !important;
    }
}
</style>
<script>
    // window.onbeforeprint = function() {
    //     console.log("Before print event triggered.");
    // };

    // window.onafterprint = function() {
    //     window.history.back();
    // };

    // window.onload = function() {
    //     window.print();
    // };
</script>
<body>
<div class="container">   
  <div class="invoice-container" ref="document" id="html">
     
    <!-- start header content side -->
     <table style="width:100%; height:auto;  text-align:center; " BORDER=0 CELLSPACING=0>
       <thead style="background:#fafafa; padding:8px;">
         <tr style="font-size: 20px;">
           <td colspan="4" style="padding:20px 20px;text-align: left;">Assets Invoice</td>
         </tr>
       </thead>
       <tbody style="background:#ffff;padding:20px;">
         <tr>
           <td colspan="4" style="padding:20px 0px 0px 20px;text-align:left;font-size: 16px; font-weight: bold;color:#000; text-transform: uppercase;">{{ $AcademyDetails->Name }}</td>
         </tr>
         <!-- <tr>
           <td colspan="4" style="text-align:left;padding:10px 10px 10px 20px;font-size:14px;">Your order details</td>
         </tr> -->
       </tbody>
     </table>
    <!-- end header content side -->

    <!-- Start Invoice details side -->
     <table style="width:100%; height:auto; background-color:#fff;text-align:center; padding:10px; background:#fafafa">
       <tbody>
         <tr style="color:#6c757d; font-size: 20px;">
           <td style="border-right:1.5px dashed  #DCDCDC; width:25%;font-size:12px;font-weight:700;padding: 0px 0px 10px 0px;">Date</td>
           <td style="border-right: 1.5px dashed  #DCDCDC ;width:25%;font-size:12px;font-weight:700;padding: 0px 0px 10px 0px;">Invoicw No.</td>
           <!-- <td style="border-right:1.5px dashed  #DCDCDC ;width:25%;font-size:12px;font-weight:700;padding: 0px 0px 10px 0px;">Payment</td> -->
           <!-- <td style="width:25%;font-size:12px;font-weight:700;padding: 0px 0px 10px 0px;">Shipping Address</td> -->
         </tr>
         <tr style="background-color:#fff; font-size:12px; color:#262626;">
           <td style="border-right:1.5px dashed  #DCDCDC ;width:25%; font-weight:bold;background: #fafafa;">{{ $ManageAssets->Date }}</td>
           <td style="border-right:1.5px dashed  #DCDCDC ;width:25% ; font-weight:bold;background: #fafafa;">{{ $ManageAssets->id }}</td>
           <!-- <td style="border-right:1.5px dashed  #DCDCDC ;width:25%; font-weight:bold;background: #fafafa;">CASH</td> -->
           <!-- <td style="width:25%; font-weight:bold;background: #fafafa;">Kosovo, Prishtina</td> -->
         </tr>
       </tbody>
     </table>
    <!-- End Invoice details side -->


     <!-- start content table -->
     <table style="width:100%; height:auto; background-color:#fff; margin-top:0px;  padding:20px; font-size:12px; border: 1px solid #ebebeb; border-top:0px;">
       <thead>
         <tr style=" color: #6c757d;font-weight: bold; padding: 5px;">
           <td colspan="1" style="text-align: left;">HEAD OF EXPENSE</td>
           <td style="text-align: center;">BANK ACCOUNT</td>
           <td style="padding: 10px;text-align:center;">DETAILS</td>
           <td style="text-align: right;padding: 10px;">AMOUNT</td>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td style="width:30%; ">{{ $ManageAssets->CategoryName }}</td>
           <td style="width:30%;padding: 10px; text-align:center;">{{ $ManageAssets->BankName. ' - ' .$ManageAssets->BankTitle  }}</td>
           <td style="width:30%;padding: 10px;text-align: center;">{{ $ManageAssets->Description }}</td>
           <td style="text-align:end;font-size:13px; width:30%;padding: 10px;text-align: end;">{{ $ManageAssets->Amount }}</td>
         </tr>
       </tbody>
     </table>
     <!-- end content table -->

     <!-- start total invoice details -->
     <table style="width:100%; height:auto; background-color:#fff;padding:20px; font-size:12px; border: 1px solid #ebebeb; border-top:0">
       <tbody>
         <tr style="padding:20px;color:#000;font-size:15px">
           <td style="font-weight: bold;padding:5px 0px">Total</td>
           <td style="text-align:right;padding:5px 0px;font-weight: bold;font-size:16px;">{{ $ManageAssets->Amount }}</td>
         </tr>

         <tr>
           <td colspan="2" style="font-weight:bold;"><span style="color:#c61932;font-weight: bold;">THANK YOU</span></td>
         </tr>
         <tr>
           <td colspan="2" style="font-weight:bold;text-align:left;padding:5px 0px 0px 00px;font-size:14px;">This is an expense invoice that confirms this amount has been withdrawn from the academy.</td>
         </tr>
       </tbody>
       <tfoot style="padding-top:20px;font-weight: bold;">
         <tr>
           <td style="padding-top:20px;">Need help? Contact us <span style="color:#c61932"> {{ $AcademyDetails->Email }} </span></td>
         </tr>
       </tfoot>
     </table>
     <!-- end total invoice details -->

</div>
</div>
</body>
</html>