<?php

use libs\Romik;
?>
<div class="col-lg-3 col-md-5 col-sm-6 col-11 login-form ">
    <h3 align="center" class="gedeant">Login</h3>
    <form id="login-form" action="<?php echo Romik::toAdminUrl() ?>" method="post">
        <?php if (!empty($error)): ?>
            <center><span class="badge badge-light" style="font-variant: initial;color:red;width: 100%;"><?= $error ?></span></center>
        <?php endif; ?>
        <div class="form-group field-loginform-username required">
            <input type="text" class="form-control field" style="box-shadow: none;" name="username" autofocus placeholder="Username" aria-required="true">

            <p class="help-block help-block-error"></p>
        </div>
        <div class="form-group field-loginform-password required">

            <input type="password" style="box-shadow: none;" class="form-control field" name="password" value="" placeholder="Password" aria-required="true">

            <p class="help-block help-block-error"></p>
        </div>
        <div class="form-group" align="center">
            <button type="submit" class="btn btn-login gedeant" name="login_button">Login</button>                </div>
    </form>
</div>
