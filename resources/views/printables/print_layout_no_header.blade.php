<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

    <script type="text/javascript" src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>  



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">
    <style type="text/css">
      .no-margin{
        margin: 0 0 0 0;
      }

      table {
        font-size: 12px
      }
      td, th {
        padding: 5px !important
      }
    </style>
  </head>
  <body onload="" onafterprint="">
    <div class="wrapper" style="overflow:hidden !important; text-align: center">
 

      
      @yield('body')
    </div>


  </body>

  @yield('scripts')
</html>