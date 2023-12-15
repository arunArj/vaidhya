<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaidhya Health Care - op ticket</title>
</head>
<body style="margin: 0; padding: 0;">
   <div class="container" style="padding: 1%; background-color: #fff;">
    <div class="header">
        <div class="main-title" style="color: rgb(24, 86, 232); text-align: center;">
            <h2 style="margin: 0; padding: 0;">Vaidhya Health Care</h2>
            <div class="fee" style="color: #fff; background-color: rgb(87, 39, 39); height: 40px; margin: 0; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px; margin-top: 6px;">
                <p style="margin: 0;">Fee : {{$fee}}</p>
            </div>
        </div>
    </div>
    <div class="patient" style="font-size: 18px;">
        <table style="width: 100%;" >
            <thead>
                <tr>
                    <td>op number : {{$billno}}</td>
                    <td colspan="2" style="text-align: right">date : {{$date}}</td>
                </tr>
                <tr >
                    <td>Name : {{$name}}</td>
                    <td>Age : {{$age}}</td>
                    <td style="text-align: right">Gender : {{$sex}}</td>
                </tr>
            </thead>
        </table>
    </div>
   </div>
   <hr>
</body>
</html>
