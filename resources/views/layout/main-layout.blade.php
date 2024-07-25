<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- start: Icons -->
    <!-- start: CSS -->
    <link rel="stylesheet" href="<?= url('template') ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= url('template') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= url('template') ?>/assets/css/custom.css">
    <link rel="stylesheet" href="<?= url('select2.css') ?>">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- end: CSS -->
    <title>{{$title ?? 'Home'}}</title>
</head>

<body>
        
    @include('layout.partials.sidebar')

    <!-- start: Main -->
    @yield('content')
    <!-- end: Main -->

    <!-- start: JS -->
    <script src="<?= url('template') ?>/assets/js/jquery.min.js"></script>
    <script src="<?= url('template') ?>/assets/js/script.js"></script>
    <script src="<?= url('template') ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= url('select2.js') ?>"></script>
    @stack('addon-script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <!-- end: JS -->

    {{-- <script src="<?= url("template/assets/js/myscript.js") ?>" defer></script> --}}
</body>

</html>
