<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>



    <!------ Include the above in your HEAD tag ---------->
    <style>
        .invoice-title h2, .invoice-title h3 {
        display: inline-block;
        }

        .table > tbody > tr > .no-line {
        border-top: none;
        }

        .table > thead > tr > .no-line {
        border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
        border-top: 2px solid;
        }
    </style>
</head>
<body>


    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice # 12345</h2>
                </div>
                <hr>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Appointment</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="" border="1" style="width:100%">
                                <thead>
                                    <tr>

                                        <td class="text-center"><strong>Patient Name</strong></td>
                                        <td class="text-center"><strong>Doctor name</strong></td>
                                        <td class="text-right"><strong>fee</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    <tr>

                                        <td class="text-center">$10.99</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$10.99</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
