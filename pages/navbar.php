<div id="blurryscroll" aria-hidden="true"></div>
<!-- Static navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="home" style=" font-weight: bold;"><?php S('app_full_name') ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">


                <a class="nav-link" href="birthday"><?php S('birthday') ?></a>
            </li>

        </ul>
        <ul class="navbar-nav">

            <?php if (isDevelopmentServer()) echo "<li class=\"nav-item\"><a  class=\"nav-link\" href=\"info\">Development Server</a></li>" ?>


        </ul>

        <?php if (getActParameter() != "write" && getActParameter() != "home") echo "<button type=\"nav-button\" class=\"btn btn-dark btn-lg\" onclick=\"location.href='write';  \">+</button>" ?>
    </div>
</nav>
