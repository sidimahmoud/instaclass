<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Instantaclass') }}</title>

  <!-- Scripts -->
  <script src="/js/app.js" defer></script>

  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">
    <script src="https://apis.google.com/js/api:client.js"></script>
</head>

<body class="bg-light">
<div id="app">
    <main >
        @yield('content')
    </main>
</div>

</body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v8.0&appId=223985172274465&autoLogAppEvents=1" nonce="V06BXP4s"></script>
</html>

<script>

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '223985172274465',
            cookie     : true,  // enable cookies to allow the server to access the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.8' // use graph api version 2.8
        });
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
