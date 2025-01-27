<meta name="title" content="@yield('title', config('app.name'))">
<meta name="description"
      content="@yield('og:description', 'CyberDude Tutorial forum is a place to submit your suggestions and vote on ideas from the community.')">
<meta property="og:title" content="@yield('og:title', config('app.name'))" />
<meta property="og:description"
      content="@yield('og:description', 'CyberDude Tutorial forum is a place to submit your suggestions and vote on ideas from the community.')" />
<meta property="og:type" content="website">
<meta property="og:url" content="@yield('og:url', url()->current())" />
<meta property="og:image" content="@yield('og:image', asset('img/cyberdude-tutorials.png'))">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('og:title', config('app.name'))">
<meta name="twitter:description"
      content="@yield('og:description', 'CyberDude Tutorial forum is a place to submit your suggestions and vote on ideas from the community.')">
<meta name="twitter:image" content="@yield('og:image', asset('img/cyberdude-tutorials.png'))">
