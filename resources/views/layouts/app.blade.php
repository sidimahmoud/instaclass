<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Instantaclasse') }}</title>

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fcf4d8bca27930018f6ea5b&product=inline-share-buttons" async="async"></script>
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M594Y7HD67"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-M594Y7HD67');
    </script>
</head>

<body>
    <noscript>
      <strong>We're sorry but Instantaclasse doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <div id="app" style="background-color: #fff">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>

<script>

    // window.fbAsyncInit = function () {
    //     FB.init({
    //         appId: '223985172274465',
    //         cookie: true,  // enable cookies to allow the server to access the session
    //         xfbml: true,  // parse social plugins on this page
    //         version: 'v2.8' // use graph api version 2.8
    //     });
    // };
    // (function (d, s, id) {
    //     var js, fjs = d.getElementsByTagName(s)[0];
    //     if (d.getElementById(id)) return;
    //     js = d.createElement(s);
    //     js.id = id;
    //     js.src = "//connect.facebook.net/en_US/sdk.js";
    //     fjs.parentNode.insertBefore(js, fjs);
    // }(document, 'script', 'facebook-jssdk'));
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
