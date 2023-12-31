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
      var pdf = "{{asset('data_file/'.$id.'/'.$nama_file)}}"
      var options = {
        height: 1000,
        duration: 700,
        backgroundColor: "#2F2F2F"
      };
      var flipBook = $("#flipbookContainer").flipBook(pdf, options);
    }
  </script>

</body>
</html>
