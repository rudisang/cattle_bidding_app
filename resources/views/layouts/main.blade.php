<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Cattle Biider App</title>
    <style>
        .trim{
            max-height: 60vh;
        }

        .dim{
            filter:brightness(50%);
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

 