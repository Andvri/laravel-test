<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                font-family: 'Helvetica', sans-serif;
                font-weight: 100;
                height: 100vh;
                color:black;
            }

            .content {
                text-align: center;
            }
            table{
                border-spacing: 0px;
            }
            table, th, td {
                color: black;
            }
            th,td{
                border: 1px solid black;
                border-collapse: collapse;
            }
            .duplicate {
                background-color: yellow;
            }
            .error{
                background-color: red;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
