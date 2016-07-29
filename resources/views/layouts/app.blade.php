<!doctype html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="utf-8">
    <link href="/css/app.css" rel="stylesheet">
  </head>

  <body>
    <header class="centered-navigation" role="banner">
  <div class="centered-navigation-wrapper">
    <a href="javascript:void(0)" class="mobile-logo">
      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_square.png" alt="Logo image">
    </a>
    <a href="javascript:void(0)" id="js-centered-navigation-mobile-menu" class="centered-navigation-mobile-menu">MENU</a>
    <nav role="navigation">
      <ul id="js-centered-navigation-menu" class="centered-navigation-menu show">
        <li class="nav-link"><a href="/">Reports</a></li>
        <li class="nav-link"><a href="/name">Names</a></li>
        <li class="nav-link"><a href="/name/donated">Filtered Names</a></li>
      </ul>
    </nav>
  </div>
</header>

    @yield('content')
  </body>
</html>
