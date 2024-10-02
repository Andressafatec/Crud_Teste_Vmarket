<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v5.15.4/css/all.css">   -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('build/assets/app-CIFRRvrY.css') }}">  

    <!-- @vite(['resources/scss/app.scss']) -->
   
    @yield('assets')
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets/img/logo.png')}}" alt="" class="">
        </div>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYFfcbqJO+gOfQ2bS3W1pMdE6LZZR5f5Dq2j5g6u5FniyD05eFGFpgxrk" crossorigin="anonymous"></script>
    <script>
        
    </script>
    @yield('scripts')
</body>

</html>
