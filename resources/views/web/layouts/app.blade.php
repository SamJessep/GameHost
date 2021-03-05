<!DOCTYPE html>
<html lang="en">
<head>
  @include('web.components.head')
  <title>@yield('title', 'Game Host')</title>
</head>
<body class="bg-gray-300 flex flex-col h-screen justify-between">
  @include('web.components.header')
  <main>
    @yield('content')
  </main>
  <footer>
    @include('web.components.footer')
  </footer>
</body>
</html>

