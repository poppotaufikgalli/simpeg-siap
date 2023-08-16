<!DOCTYPE html>
<html lang="id">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-37NN2X5QVQ"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-37NN2X5QVQ');
        </script>
        @include('partials.seo')
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon/favicon.ico')}}" />
        <!-- Core theme CSS (includes Bootstrap)-->
        @vite(['resources/css/styles.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
        <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
    </head>
    <body>