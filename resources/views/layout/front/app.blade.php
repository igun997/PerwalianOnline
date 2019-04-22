<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title","Kicau Burung")</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style media="screen">
      .navbar {
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
      }
      .navbar-brand {
        padding: 0px; /* firefox bug fix */
      }
      .navbar-brand>img {
        height: 100%;
        padding: 15px; /* firefox bug fix */
        width: auto;
      }
    </style>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-default navbar-inverse">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">
              <img src="{{url("public/assets/image/logo.png")}}" style="width:100%" alt="">
            </a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{url("")}}">Beranda</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{url("login")}}">Login</a></li>
              <li><a href="{{url("register")}}">Register</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
      @yield("content")
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
