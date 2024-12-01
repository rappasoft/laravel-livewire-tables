<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    Laravel Testing Layout
    <div>
    {{ $slot }}
    </div>
</body>
</html>


