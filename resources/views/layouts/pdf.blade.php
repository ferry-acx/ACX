<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<style>
.page-break {
    page-break-after: always;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

.center {
    padding-left: 32%;
}

.text-header {
    text-align: center;
}
</style>

<body>
    <img src="{{public_path('logo-acx.jpg')}}" alt="ACX Logo" width="350px" height="100px" style="margin-left: 25%;">
    <div class="text-header">
        <p style="font-size: 30px; font-family: arial, sans-serif; font-weight: bolder;">Employee Reports</p>
        <p style="font-size: 15px; font-family: arial, sans-serif; font-weight: bolder; margin-top:-10px">{{$dates[0]}}
            — {{$dates[1]}}</p>
    </div>

    <main class="">
        @yield('content')
    </main>
</body>

</html>