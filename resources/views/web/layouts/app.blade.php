<!DOCTYPE html>
<html lang="en">
<head>
  @include('web.sections.head')
  <title>@yield('title', 'Game Host')</title>
</head>
<body class="bg-gray-300 flex flex-col">
  @include('web.sections.top-bar.header')
  <main class="flex-grow">
    @yield('content')
  </main>
  <footer>
    @include('web.sections.footer')
  </footer>
</body>
</html>

