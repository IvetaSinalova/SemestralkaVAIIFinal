<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header text-center">
                    <h4 class="card-title mt-2">Zmeniť heslo</h4>
                </header>
                <br>
                <form method="post" action="?c=auth&a=changePassword">
                    <div class="row justify-content-center">
                        <div class="col-11 form-group">
                            <label for="email" class="text-uppercase">Email</label>
                            <input type="text" class="form-control" id="email" name="email" <?php if ($data['email'] != null){ ?>value="<?= $data['email'] ?>" <?php } ?>required>
                            <?php if ($data['errorEmail'] != null) { ?>
                                    <br>
                                <div class="alert errorMessage alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?= $data['errorEmail'] ?></strong>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="col-11 form-group">
                            <label for="old_password" class="text-uppercase">Staré heslo</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                            <?php if ($data['errorOldPassword'] != null) { ?>
                                <br>

                                <div class="alert errorMessage alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?= $data['errorOldPassword'] ?></strong>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="col-11 form-group">
                            <label for="new_password" class="text-uppercase">Nové heslo</label>
                            <input type="password" class="form-control" id="new_password" minlength="6" name="new_password" required>
                            <?php if ($data['errorNewPassword'] != null) { ?>
                                <br>

                                <div class="alert errorMessage alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?= $data['errorNewPassword'] ?></strong>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-11 form-group">
                            <button type="submit" class="btn-card">Prihlásiť sa</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script src="public/javaScript.js"></script>