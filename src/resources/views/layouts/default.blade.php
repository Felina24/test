<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <title>FashionablyLate</title>
    @yield('css')
</head>

<body class="@yield('body-class')">
    <header class="header">
        <h1 class="logo">FashionablyLate</h1>
        <div class="header-extra">
        @yield('header-extra')
        </div>
    </header>

  <main>
    @yield('content')
  </main>
   @yield('scripts') 
</body>

</html>
