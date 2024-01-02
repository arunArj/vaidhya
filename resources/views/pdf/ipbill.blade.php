<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaidhya Health Care - Ip Invoice</title>
</head>
<body style="margin: 0; padding: 0;">
   <div class="container" style="padding: 1%; background-color: #fff;">
    <div class="header">
        <div class="main-title" style="color: rgb(24, 86, 232); text-align: center;">
            <h2 style="margin: 0; padding: 0;">Vaidhya Health Care</h2>
            {{-- <div class="fee" style="color: #fff; background-color: rgb(87, 39, 39); height: 40px; margin: 0; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px; margin-top: 6px;">
                <p style="margin: 0;">Fee : {{$fee}}</p>
            </div> --}}
            <h4>IP Invoice</h4>
            <table style="width: 100%;" >
                <thead>
                    <tr>
                        <td>GST NO :{{$gst_no}} </td>
                        <td colspan="2" style="text-align: right">DATE& TIME :{{$date}}</td>
                    </tr>
                    <tr >
                        <td>Bill No :{{$bill_no}} </td>
                    </tr>
                </thead>
            </table>
            <hr>
        </div>
    </div>
    <div class="patient" style="font-size: 18px;">
        <table style="width: 100%;" >
            <thead>
                <tr>
                    <td>Name   : {{$name}}</td>
                    <td colspan="2" style="text-align: right">Sex :{{$sex}}</td>
                </tr>
                <tr >
                    <td>MRD NO : {{$mrd_no}}</td>
                    <td>IP NO : {{$ip_number}}</td>
                    <td style="text-align: right">Room NO: {{$room}}</td>
                </tr>
            </thead>
        </table>
        <hr>
    </div>
    <div class="bills" style="font-size: 18px;margin-top:40px">
        <table style="width: 100%;" border="1px">
            <thead>
                <tr>
                    <th>SL NO </th>
                    <th>Particulars</th>
                    <th>Quantity</th>
                    <th>Fee</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($fees as $key=>$item)


                <tr style="border-bottom: 1px solid black;">
                   <td style="text-align: right    ">{{++$key}}</td>
                   <td style="text-align: right    ">{{$item['title']}}</td>
                   <td style="text-align: right    ">{{$item['quantity']}}</td>
                   <td style="text-align: right    ">{{$item['fee']}}</td>
                </tr>
                @endforeach
                <tr style="border-bottom: 1px solid black;">
                    <td colspan="2" style="text-align: center    ">Refund :</td>
                    <td style="text-align: right" colspan="2">-{{$refund}}</td>
                </tr>
                <tr style="border-bottom: 1px solid black;">
                    <td colspan="2" style="text-align: center    ">Grand Total :</td>
                    <td style="text-align: right" colspan="2">{{$amount}}</td>
                </tr>
            </tbody>
        </table>
    </div>
   </div>

</body>
</html>
