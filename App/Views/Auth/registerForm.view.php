<?php /** @var Array $data */ ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Registrácia</h4>
                </header>
                <article class="card-body">
                    <form method="post" action="?c=auth&a=register" enctype="multipart/form-data" id="registerForm">
                        <div class="text-center">
                            <img src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>"
                                 alt="profile_picture">
                            <input type="file" class="file-upload" name="profile_picture" id="profile_picture">
                        </div>
                        </hr><br>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="name">Meno</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="col form-group">
                                <label for="last_name">Priezvisko</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bday">Dátum narodenia</label>
                            <input type="date" id="bday" name="bday">
                            <div id="errorBirthdate"></div>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" placeholder="" name="email" id="email"
                                       required>
                            </div>

                            <?php if ($data['error'] != null) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?= $data['error'] ?></strong>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="password">Heslo</label>
                                <input class="form-control" type="password" name="password" id="password" minlength="6"
                                       required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Registrovať</button>
                            </div>
                    </form>
                </article>
                <div class="border-top card-body text-center">Máte účet? <a href="?c=auth&a=loginForm">Prihlásiť sa</a>
                </div>
            </div>
        </div>

    </div>


</div>


<script src="public/javaScript.js"></script>