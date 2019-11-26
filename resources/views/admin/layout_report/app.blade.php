<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> @yield('reportName') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 3.3.7 -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin-lte') }}/bower_components/bootstrap/dist/css/bootstrap.min.css"> --}}
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin-lte') }}/bower_components/font-awesome/css/font-awesome.min.css"> --}}

  @stack('css')

</head>

<body>

@yield('content')

</body>
</html>
