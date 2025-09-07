<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <title>FashionablyLate</title>
    @yield('css')
</head>

<body>
    <header class="header">
        @yield('header-extra')
        <h1 class="logo">FashionablyLate</h1>
    </header>

  <main>
      @yield('content')
  </main>
</body>

</html>
