<?php require_once 'pages/header.php'; ?>

<style>


    /*데스크탑*/
    @media screen and (min-width: 1367px) {

        #cardpaper {
            width: 70%;
        }

    }

    /*랩탑*/
    @media screen and (min-width: 1025px) and (max-width: 1366px) {

        #cardpaper {
            width: 70%;
        }


    }

    /*아이패드 가로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {

    }

    /*아이패드 세로*/
    @media screen and (min-width: 768px) and (max-width: 1024px) and (orientation: portrait) {

    }

    /*모바일*/
    @media screen and (min-width: 351px) and (max-width: 767px) {

    }

    /*작은 모바일*/
    @media screen and (max-width: 350px) {

    }
</style>


<!-- html -->

<div class="container">

    <!--      <h1 style="font-size: 36px; center;">HaruCore</h1>-->
    <br><br>
    <h1 style="font-size: 48px;">
        Ver <?php echo PostAct(getAPIUrl(), array(array('api_key', getAPIKey()), array('a', 'CoreVersion'))); ?></h1>
    <br>

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <a href="http://unopenedbox.com/develop/square/" class="btn btn-dark" role="button">s9uare Development</a>
        </div>
        <div class="btn-group" role="group">
            <a href="http://unopenedbox.com/" class="btn btn-dark" role="button">UnopenedBox</a>
        </div>
    </div>

    <br><br>

    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="thumbnail">
                <!--       <img src="..." alt="..."> -->
                <div class="caption">
                    <h3>Information</h3>
                    <a href="http://unopenedbox.com/index.php?mid=updates&category=228319" class="btn btn-outline-dark"
                       role="button">Changelog</a>
                    <a href="http://unopenedbox.com/notice" class="btn btn-outline-dark" role="button">Notice</a>
                    <a href="http://unopenedbox.com/fsquare_feedback" class="btn btn-outline-dark" role="button">FeedBack</a>
                    <a href="license" class="btn btn-outline-dark" role="button">Open Source License</a>


                </div>

            </div>


        </div>
        <div class="col-sm-6 col-md-6">

            <div class="thumbnail">
                <!--       <img src="..." alt="..."> -->
                <div class="caption">
                    <h3>Developer</h3>

                    <p>Junghoon Lee(JHRunning)</p>
                    <a href="http://jhrun.tistory.com" class="btn btn-outline-dark" role="button">Blog</a>
                    <a href="http://facebook.com/jhrunning" class="btn btn-outline-dark" role="button">Facebook</a>
                </div>
            </div>


        </div>


    </div>

</div>

</div>