<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
        }

        .company-info {
            width: 300px;
        }

        .logo {
            width: 200px;
            height: auto;
            float: right;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 11pt;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/img/logo.png') }}" alt="logo" class="logo">
        <div class="company-info">
            <h2>CV. Degrees Golf</h2>
            <p>Jl. Urip Sumoharjo, Kel. Panaikang, Kec. Panakkukang, Kota Makassar</p>
        </div>
    </div>

    <h3>Grip Purchases Report</h3>
    <p>{{ Carbon\Carbon::parse($purchases[0]->date)->isoFormat('MMMM YYYY') }}</p>


</body>

</html>