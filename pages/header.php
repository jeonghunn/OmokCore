<!DOCTYPE html>
<html ng-app="FavoriteApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="icon.png">

    <title>Favorite</title>

    <!-- Bootstrap core CSS -->
    <link href="pages/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="pages/css/navbar-fixed-top.css" rel="stylesheet">

        <!-- JS -->
             <script src="pages/js/angular.min.js"></script>
      <script type="text/javascript" src="pages/js/jquery.js"></script>

    <script src="pages/js/class.js"></script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body ng-controller="FavoriteCtr">

<?php if(REQUEST('nav') != 'false') require_once 'pages/navbar.php'; ?>

 <div class="container">


