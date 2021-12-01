<?php /** @var Array $data */ ?>
<section class="login-block">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-5 login-sec">
                <form class="login-form" method="post" action="?c=auth&a=login">
                    <div class="form-group">
                        <label for="login_email" class="text-uppercase">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="login_password" class="text-uppercase">Heslo</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                   <?php if($data['error'] != null) {?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><?= $data['error'] ?></strong>
                        </div>
                    <?php } ?>
                        <button type="submit" class="btn">Prihlásiť sa</button>
                </form>
            </div>
        </div>
    </div>
</section>

