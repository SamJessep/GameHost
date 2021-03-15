<!DOCTYPE html>
<html lang="en">
<head>
  @include('web.components.head')
  <title>@yield('title', 'Game Host')</title>
</head>
<body class="bg-gray-300 h-screen">
  @include('web.components.header')
  <main>
    @yield('content')
  </main>
  <footer>
    @include('web.components.footer')
  </footer>
</body>
</html>

