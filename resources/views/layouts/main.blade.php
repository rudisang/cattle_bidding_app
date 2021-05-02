<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Cattle Biider App</title>
    <style>
   
    </style>
    <link rel="stylesheet" href="https://morentoapp.000webhostapp.com/index.css">
</head>
<body class="display">
   <header>
       <x-navigation-bar />

   </header>

   <main>
       @yield('content')
   </main>
   <script src="{{asset('js/jquery.min.js')}}"></script>
   <script src="{{asset('js/bootstrap.popper.min.js')}}"></script>
   <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>   

 