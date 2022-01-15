<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astrid and Carlos</title>
    <link rel="stylesheet" href="/assets/css/vuetify.min.css">
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/css/flex.css">
    <link rel="stylesheet" href="/assets/css/misc.css">
    <link rel="stylesheet" href="/assets/css/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <script src="/assets/js/boxicons.js"></script>
    <script src="/assets/js/jquery-3.6.0.js"></script>
    <script src="/assets/js/vue.js"></script>
    <script src="/assets/js/vuetify.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <style>
        body,html{
            width:100%;
            min-width: 100%;
            height:100%;
            min-height: 100%;
            overflow: hidden;
        }
    </style>
    @yield('head')
</head>

<body>
    @yield('header')
    @yield('content')
    @yield('footer')
    @yield('scripts')
    @include('layout.bottom-navigation')
</body>


</html>