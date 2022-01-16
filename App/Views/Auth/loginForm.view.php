<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Prihlásiť sa</h4>
                </header>
                <br>
                <form method="post" action="?c=auth&a=login">
                    <div class="row justify-content-center">
                        <div class="col-11 form-group">
                            <label for="email" class="text-uppercase">Email</label>
                            <input type="text" class="form-control" id="email" name="email" <?php if($data['email']!=null){?>value="<?= $data['email']?>" <?php }?> required>
                        </div>
                        <?php if($data['errorEmail'] != null) {?>
                                <div class="col-11">
                                    <div class="alert errorMessage alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><?= $data['errorEmail'] ?></strong>
                                    </div>
                                </div>
                        <?php } ?>
                        <div class="col-11 form-group">
                            <label for="password" class="text-uppercase">Heslo</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <?php if($data['errorPassword'] != null) {?>
                                <div class="col-11">
                                    <div class="alert errorMessage alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><?= $data['errorPassword'] ?></strong>
                                    </div>
                                </div>

                        <?php } ?>
                        <div class="col-11 form-group">
                            <button type="submit" class="btn-card">Prihlásiť sa</button>
                        </div>
                    </div>
                    <div class="border-top card-body text-center">Zabudli ste heslo? <a href="?c=auth&a=changePasswordForm">Zmeniť heslo</a></div>

                </form>
            </div>
        </div>
    </div>
</div>


