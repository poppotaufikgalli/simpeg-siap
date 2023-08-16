<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Embed FlipBook</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  
  <!-- Flipbook StyleSheet -->
  <link href="{{asset('assets/flipbook/dflip/css/dflip.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Icons Stylesheet -->
  <link href="{{asset('assets/flipbook/dflip/css/themify-icons.min.css')}}" rel="stylesheet" type="text/css">
  
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
  <div id="flipbookContainer"></div>

  <!-- jQuery  -->
  <script src="{{asset('assets/flipbook/dflip/js/libs/jquery.min.js')}}" type="text/javascript"></script>
  <!-- Flipbook main Js file -->
  <script src="{{asset('assets/flipbook/dflip/js/dflip.min.js')}}" type="text/javascript"></script>
  <!-- Flipbook main Js file -->
  <script>
    window.onload = (event)=> {
      //uses source from online(make sure the file has CORS access enabled if used in cross domain)
      //var pdf = 'https://mozilla.github.io/pdf.js/web/compressed.tracemonkey-pldi-09.pdf';
      var pdf = "{{asset($path.'/'.$filename)}}"
      var options = {
        height: 1000,
        duration: 700,
        backgroundColor: "#2F2F2F"
      };
      var flipBook = $("#flipbookContainer").flipBook(pdf, options);
    };
  </script>

</body>
</html>
