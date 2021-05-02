<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://morentoapp.000webhostapp.com/dash.css">
    <title>Dashboard Cattle Bidder App</title>
    
</head>

<body class="display">
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