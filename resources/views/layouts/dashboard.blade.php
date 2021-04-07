<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Dashboard Cattle Bidder App</title>
    <style>
        body {
            background-color: #F3F4F6;
        }

        #card{
            margin-top:-50px !important;
            transition: 1s;
        }

        #card:hover{
            position: relative;
            margin-top:-30px !important;
            transition: 1s;
        }
    </style>
</head>

<body>
    <header>
        <x-dashboard-nav />
        @yield('breadcrumb')
    </header>

    <main>
        @yield('content')
    </main>
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/editor.js')}}"></script>
    <script src="{{asset('js/axios.js')}}"></script>
    @yield('scripts')
</body>

</html>