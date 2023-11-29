<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital OP Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        /* Basic styling for the ticket */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .hospital-name {
            font-size: 28px;
            font-weight: bold;
        }
        .ticket {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 0 auto;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="row align-items-center">
          <div class="col-12">
            <h2>Vaidhya Health Care</h2>
          </div>
          <div class="col-12">
           <h4>OP Ticket</h4>
          </div>
        </div>
      </div>
    <div class="ticket">
        <div class="details">
            <p><strong>Patient Name:</strong> {{$name}}</p>
            <p><strong>Date:</strong>{{$date}}</p>

        </div>
        <hr>
        <p><strong>Note:</strong> Please arrive 15 minutes before the appointment time. Bring your ID and any medical documents.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
