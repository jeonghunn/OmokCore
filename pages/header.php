<!DOCTYPE html>
<html>
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-48564071-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-48564071-2');
    </script>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="description" content="">

    <meta name="author" content="">
    <!-- See https://goo.gl/qRE0vM -->
    <meta name="theme-color" content="<?php getTitleColor() ?>">


    <link rel="shortcut icon" href="icon.png">

    <title><?php
        if ($html_title == null) {

            S('app_full_name');
        } else {
            echo $html_title;

        }
        ?></title>


    <!-- will be replaced with elements/elements.vulcanized.html -->


    <!---->
    <!--      <link rel="import" href="pages/bower_components/polymer/polymer.html">-->
    <!--      <link rel="import" href="pages/bower_components/app-layout/app-drawer/app-drawer.html">-->
    <!--      <link rel="import" href="pages/bower_components/app-layout/app-drawer-layout/app-drawer-layout.html">-->
    <!--      <link rel="import" href="pages/bower_components/app-layout/app-header/app-header.html">-->
    <!--      <link rel="import" href="pages/bower_components/app-layout/app-header-layout/app-header-layout.html">-->
    <!--      <link rel="import" href="pages/bower_components/app-layout/app-scroll-effects/app-scroll-effects.html">-->
    <!--      <link rel="import" href="pages/bower_components/app-layout/app-toolbar/app-toolbar.html">-->
    <!--      <link rel="import" href="pages/bower_components/app-route/app-location.html">-->
    <!--      <link rel="import" href="pages/bower_components/app-route/app-route.html">-->
    <!--      <link rel="import" href="pages/bower_components/iron-pages/iron-pages.html">-->
    <!--      <link rel="import" href="pages/bower_components/iron-icons/iron-icons.html">-->
    <!--      <link rel="import" href="pages/bower_components/iron-selector/iron-selector.html">-->
    <!--      <link rel="import" href="pages/bower_components/paper-icon-button/paper-icon-button.html">-->
    <!--      <link rel="import" href="pages/bower_components/paper-card/paper-card.html">-->
    <!--      <link rel="import" href="pages/bower_components/paper-toolbar/paper-toolbar.html">-->


    <script>


    </script>
    <!-- Bootstrap core CSS -->
    <link href="pages/css/bootstrap.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="pages/js/popper.min.js"></script>
    <script src="pages/js/bootstrap.bundle.js"></script>
    <!--     Bootstrap ColorPicker -->
    <script src="pages/js/ColorPicker/bootstrap-colorpicker.js"></script>
    <link rel="stylesheet" href="pages/css/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="pages/css/pickr.min.css"/>
    <!--     font -->
    <link rel="stylesheet" href="//cdn.rawgit.com/hiun/NanumSquare/master/nanumsquare.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>


    <!--      Icons-->
    <link rel="stylesheet" href="pages/css/iconic/open-iconic-bootstrap.css">

    <!--     Medium Editor -->
    <link rel="stylesheet" href="pages/css/medium-editor.css">
    <link rel="stylesheet" href="pages/css/beagle.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css">


    <!--     egjs -->
    <script src="pages/js/hammer.min.js"></script>
    <script src="pages/js/eg.min.js"></script>

    <!--      Interect-->
    <script src="http://code.interactjs.io/interact-1.2.4.min.js"></script>

    <!--     Animation -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <![endif]-->

    <style>

        /*font*/
        @import url(https://fonts.googleapis.com/earlyaccess/nanumbrushscript.css);
        @import url(https://fonts.googleapis.com/earlyaccess/nanumgothic.css);
        @import url(https://fonts.googleapis.com/earlyaccess/nanummyeongjo.css);


        body {

            display: block;
        }

        .cardtextarea {
            background: transparent;
            resize: none;
            border: 0 none;
            width: 92%;
            font-size: 24px;
            outline: none;
            height: 92%;
            vertical-align: middle;
        }

        .outer {
            display: table;
            width: 440px;
            margin-top: 24px;
        }

        .tablerow {

            display: table-row;

        }


        .squarecard {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
            font-family: 'Roboto', 'Noto', sans-serif;
            background-color: #FFFFFF;
            transition: 0.3s;
            /*   border-radius: 16px; 5px rounded corners */
            width: 440px;
            height: 440px;
            padding-left: 24px;
            padding-right: 24px;
            padding-bottom: 24px;
            padding-top: 16px;
            font-size: 24px;

            word-break: break-all;
            display: table-cell;

            vertical-align: middle; /* fixed with a valid value*/

        }


        /* On mouse-over, add a deeper shadow */
        .squarecard:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }


        .centered {
            margin-left: auto;
            margin-right: auto;
            position: relative;
            top: 50%;
            transform: translateY(25%);
        }

        .resize-drag {
            z-index: 200;
            border: 2px dashed #ccc;
            max-height: 440px;
            max-width: 440px;
        }


        /*데스크탑*/
        @media screen and (min-width: 1367px) {

            #cardpaper {
                width: 60%;
            }

            img {
                max-width: 1000px;
            }

        }

        /*랩탑*/
        @media screen and (min-width: 1025px) and (max-width: 1366px) {

            #cardpaper {
                width: 60%;
            }

            img {
                max-width: 1000px;
            }
        }

        /*아이패드 가로*/
        @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {

            img {
                max-width: 760px;
            }
        }

        /*아이패드 세로*/
        @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: portrait) {
            img {
                max-width: 760px;
            }
        }

        /*모바일*/
        @media screen and (min-width: 351px) and (max-width: 767px) {
            .squarecard {

                width: 100%;
                max-width: 100%
            }

            .outer {
                width: 100%;
            }

            img {
                max-width: 100%
            }


        }

        /*작은 모바일*/
        @media screen and (max-width: 350px) {
            .squarecard {
                max-width: 100%
                width: 100%;

            }

            .outer {
                width: 100%;
            }

            img {
                max-width: 100%
            }


        }


    </style>

    <style>
        body {
            margin: 0;
            font-family: 'Roboto', 'Nanum Square', 'Noto', sans-serif;
            -webkit-font-smoothing: antialiased;
            line-height: 1.5;
            min-height: 100vh;
            /*background-color: #eeeeee;*/
            background-image: linear-gradient(0deg, #FFFFFF, #f8f9fa);
        }


    </style>


</head>

<body>


<?php if (REQUEST('nav') != 'false') require_once 'pages/navbar.php'; ?>

