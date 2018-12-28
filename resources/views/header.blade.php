<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - Pengaturan Sistem</title>
    <link rel="stylesheet" type="text/css" href="{{ mix('css/admin.css') }}">
</head>
<body>

<div class="container">
    <div class="pad-top">
    </div>
    <div class="row justify-content-center">
        @yield('content')
    </div>
</div>
</body>
</html>

