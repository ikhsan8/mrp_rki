<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Delivery</title>
    <style type="text/css">
 html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed, 
        figure, figcaption, footer, header, hgroup, 
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
            font-family: sans-serif;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure, 
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .content {
            margin-top: 30px;
            margin-left: 40px;
            margin-right: 40px;
        }

        .content .header {
            text-align: center;
        }

        .content .header .company-name {
            font-size: 16px;
        }

        .content .header .company-address {
            margin-top: 7px;
            font-size: 11px;
        }

        .bold {
            font-weight: bold;
        }

        .content .header .title {
            font-size: 14px;
        }

        .content .header .period {
            font-size: 13px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        
        .employee-information {
            letter-spacing: 0.1px;
            margin-top: 19px;
            margin-bottom: 19px;
        }

        .employee-information::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .question {
            font-size: 11px;
            margin: 5px 0;
            display: inline-block;
        }
        
        .question-extra {
            font-size: 11px;
            /* margin: 5px 0; */
            display: inline-block;
        }

        .left .question {
            width: 40%;
        }

        .note{
            font-size: 11px;
            margin: 5px 0;
            /* display: inline-block; */
        }

        .left-note{
            width: 80%;
            float: left;
        }

        .right .question {
            width: 35%;
        }

        .answer {
            font-size: 11px;
        }
        
        .answer-extra {
            font-size: 11px;
            display: inline-block;
        }

        .left {
            float: left;
            width: 40%;
        }

       .right {
            float: right;
            width: 40%;
        }

        .detail-left {
            float: left;
            width: 60%;
        }

       .detail-right {
            float: right;
            width: 40%;
        }

        .detail-left .bold,
        .detail-right .bold {
            font-size: 11px;
        }

        .detail-header {
            letter-spacing: 0.1px;
            margin-top: -2px;
            margin-bottom: -2px;
        }

        .detail-header::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .detail-content {
            letter-spacing: 0.1px;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 11px;
        }

        .detail-content::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .detail-content .question {
            font-size: 11px;
            margin: 4px 0;
            display: inline-block;
        }

        .detail-left .question {
            width: 40%;
        }

        .detail-right .question {
            width: 60%;
        }
        
        .detail-right .question-extra {
            width: 40%;
        }

        .detail-footer {
            letter-spacing: 0.1px;
            margin-top: -10px;
            margin-bottom: -4px;
        }

        .detail-footer::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .footer-left {
            float: left;
            width: 60%;
        }

       .footer-right {
            float: right;
            width: 40%;
        }

        .footer-left .question {
            width: 30%;
        }

        .footer-right .question {
            width: 35%;
        }

        .footer {
            letter-spacing: 0.1px;
            margin-top: 15px;
        }

        .footer .question {
            font-size: 11px;
            margin: 3px 0;
            display: inline-block;
        }

        .footer::after {
            clear: both;
            height: 0;
            width: 100%;
            content: '';
            display: block;
        }

        .center {
            margin: auto;
            display: block;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
        }

        p{
            line-height: 20px;
        }

        th {
            padding: 15px;
            border-bottom: 2px solid black;
            margin-bottom: 20px;
        }

        td {
            padding:15px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="employee-information">
            <div style="text-align: left; margin-top: 10px">
                <p class="bold" style="font-size: 17px;">{{ $name }}</p>
            </div>
            <div class="left">
                <div style="text-align: left; margin-top: 10px">
                    <div class="col-sm-5 ">
                        <address>FACTORY : <p>{{ $address1 }}{{ $address2 }}</p>
                        <p> Phone : &nbsp;{{ $phone }}</p>
                        <p> Fax : &nbsp;{{ $fax }}</p>
                        </address>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="col-sm-4" style="  border: 1px solid black; border-radius: 5px; padding: 5px;">
                    KEPADA YTH :
                    <address> 
                        <div style="text-align: left; margin-top: 10px">
                            <p class="bold" style="font-size: 15px;">{{ $shipments->customer->customer_name }}</p>
                            <p class="" style="font-size: 15px;"> {{ $shipments->customer->address }}</p>
                        </div>
                    </address>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div style="text-align: center; margin-top: 10px">
            <p class="bold" style="font-size: 25px;">SURAT JALAN</p>
        </div>
        <div class="left">
            <div style="text-align: left; margin-top: 10px">
                <div class="col-sm-5 ">
                    <address>
                    <p> 
                        Tanggal : &nbsp;{{ $shipments->delivery_date }}
                    </p>
                    <p> 
                        NO DN   : &nbsp;{{ $shipments->dn_code }}
                    </p>
                    </address>
                </div>
            </div>
        </div>
        <div class="right">
            <br>
            <p>
                No.Kendaraan : {{ $shipments->vehicle->car_code }}
            </p>
        </div>
    <br>
    <br>
    <br>
    <br>
<!-- Table row -->
<div class="row">
    <div class="col-sm-12" style="height:200px;">
        <table width="100%" style="  border: 1px solid black;  padding: 5px;">
            <thead align="Center">
                <tr>
                    <th style="  border: 1px solid black;  padding: 5px;">NO</th>
                    <th style="  border: 1px solid black;  padding: 5px;">NAMA BARANG</th>
                    <th colspan="2" style="  border: 1px solid black;  padding: 5px;">JUMLAH</th>
                    <th style="  border: 1px solid black;  padding: 5px;">NO. PO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventory_shipments as $inventory_shipment)
                <tr>
                    <td align="center" style="border-left: 1px solid;border-right: 1px solid;height: 20px;">{{ $loop->iteration }}</td>
                    <td align="Left" style="border-left: 1px solid;border-right: 1px solid;height: 20px;">&nbsp;&nbsp;{{ $inventory_shipment->inventoryProductList->product->product_name }}</td>
                    <td align="center" style="border-left: 1px solid;height: 20px;">{{ $inventory_shipment->quantity }}</td>
                    <td align="center" style="border-right: 1px solid;height: 20px;">{{ $inventory_shipment->unit->unit_code }}</td>
                    <td align="Left" style="border-left: 1px solid;border-right: 1px solid;height: 20px;">&nbsp;&nbsp;{{ $inventory_shipment->po_code }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
                    
        <!-- Table row -->
<div class="row">
    <div class="col-12">
        <table width="100%">
            <thead>
                <tr>
                    <th class="text-center" colspan="3">Penerima</th>
                    <th class="text-center" style="border: none;  padding: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th class="text-center">Pengirim</th>
                </tr>
                <tr>
                    <th class="text-center" style="border: 1px solid black;  padding: 5px;height: 15px;">Security</th>
                    <th class="text-center" style="border: 1px solid black;  padding: 5px;height: 15px;">Driver</th>
                    <th class="text-center" style="border: 1px solid black;  padding: 5px;height: 15px;">Approved</th>
                    <th class="text-center" style="border: none;  padding: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th class="text-center" style="border: 1px solid black;  padding: 5px;height: 15px;">Hormat Kami</th>
                </tr>
            </thead>
            <tbody>
                <tr style="height: 100px;">
                    <td class="text-center" style="vertical-align:bottom;border: 1px solid;height: 80px;">( ................................)</td>
                    <td class="text-center" style="vertical-align:bottom;border: 1px solid;height: 80px;">( ................................)</td>
                    <td class="text-center" style="vertical-align:bottom;border: 1px solid;height: 80px;">( ................................)</td>
                    <td class="text-center" style="vertical-align:bottom;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class="text-center" style="vertical-align:bottom;border: 1px solid;height: 80px;">( ................................)</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->                                        
    
    </div>
</body>
</html>