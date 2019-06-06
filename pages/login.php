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


<paper-material elevation="1" id="cardpaper" style="margin-top: 3%;  height: auto;">

    <form id="signinform" name="signinform" method='post'
          action='<?php echo getClientUrl(true) . "index.php?a=loginact'"; ?>'>
        <h2 class="form-signin-heading"><?php S('sign_in'); ?></h2>

        <paper-input type="email" name='email_form' id="email_form" placeholder="<?php S('email'); ?>" required
                     autofocus></paper-input>
        <paper-input type="password" name='password_form' id="password_form" placeholder="<?php S('password'); ?>"
                     required></paper-input>
        <input id="email" name="email" style=" display: none;"/>
        <input id="password" name="password" style=" display: none;"/>

        <div>
            <paper-checkbox id="keep_signed_in_form"
            "><?php S('keep_signed_in'); ?></paper-checkbox><input type="hidden" id="keep_signed_in"
                                                                   name="keep_signed_in"/><a href="signup"
                                                                                             style="float:right;"><?php S('sign_up'); ?></a>
        </div>
        <br><br>
        <paper-button raised onclick="validcheckandsubmit();"><?php S('sign_in'); ?></paper-button>


    </form>

</paper-material>

<paper-toast text="<?php S('sign_in_blank_des'); ?>" id="sign_in_blank_error_toast"></paper-toast>

<script>


    $("#signinform").keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            validcheckandsubmit();
        }
    });

    //    signinform.addEventListener('iron-form-response', function(event) {
    //        alert(event.detail.text);
    //    });

    function validcheckandsubmit() {


        document.getElementById('email').value = document.getElementById('email_form').value;

        document.getElementById('password').value = document.getElementById('password_form').value;

        document.getElementById('keep_signed_in').value = document.getElementById('keep_signed_in_form').checked;


        document.getElementById('signinform').submit();


        if (document.getElementById('email_form').value == '' || document.getElementById('password_form').value == '') {
            document.querySelector('#sign_in_blank_error_toast').show();
            return false;
        } else {
            document.getElementById('signinform').submit();

            return false;
        }
    }

</script>