<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">


    <style>
        body {
            background-image: url('{{ asset('images/image-baru.jpeg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 99vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
    </style>
</head>

<body>
    @yield('content')
    <script src="https://www.google.com/recaptcha/api.js"></script>
</body>

</html>
