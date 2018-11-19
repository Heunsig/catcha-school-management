<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catcha</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css')}}">
</head>
<body>
  <div id="app"></div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>