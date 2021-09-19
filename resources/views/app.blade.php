<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/page.js/1.11.6/page.js" integrity="sha512-MkYIEFfyoRmnQFt8ZoTflIGLT8RR+PfZSHtsG5Knc5uFayAspGft8XTaMIOozqD4KkGzE6xa7jU+tfWtcXMqtg==" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>


<body>
<main class="main">
    @yield('content')
</main>
<script defer src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
