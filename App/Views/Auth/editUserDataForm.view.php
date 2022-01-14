<?php /** @var Array $data */ ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <article class="card-body">
                    <form method="post" action="?c=auth&a=setUserData" enctype="multipart/form-data" id="registerForm">
                        <div class="text-center">
                            <img class="crop" src="<?= $data['profile_picture'] != null ? \App\Config\Configuration::UPLOAD_DIR . $data['profile_picture'] : \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>" alt="avatar">
                            <input type="file" class="file-upload" name="profile_picture" id="profile_picture" >
                            <input type="hidden" id="old_profile_picture" name="old_profile_picture" value="<?= $data['profile_picture']?>">
                        </div>
                        </hr><br>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="name">Meno</label>
                                <input type="text" class="form-control" name="name" id="name" <?php if($data['name']!=null){?> value="<?=$data['name']?>" <?php }?>required>
                                <div id="errorName"></div>
                            </div>
                            <div class="col form-group">
                                <label for="last_name">Priezvisko</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" <?php if($data['last_name']!=null){?> value="<?=$data['last_name']?>" <?php }?> required>
                                <div id="errorLastName"></div>
                            </div>
                        </div>
                        <?php if ($data['errorName'] != null) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['errorName'] ?></strong>
                            </div>
                        <?php } ?>
                        <?php if ($data['errorLastName'] != null) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['errorLastName'] ?></strong>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="bday">Dátum narodenia</label>
                            <input type="date" id="bday" name="bday" <?php if($data['bday']!=null){?> value="<?=$data['bday']?>" <?php }?> required>
                            <div id="errorBirthdate"></div>
                        </div>
                        <?php if ($data['errorBirthdate'] != null) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['errorBirthdate'] ?></strong>
                            </div>
                        <?php } ?>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" placeholder="" name="email" id="email" <?php if($data['email']!=null){?> value="<?=$data['email']?>" <?php }?> required>
                                <div id="errorEmail"></div>
                            </div>

                            <?php if ($data['errorEmail'] != null) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?= $data['errorEmail'] ?></strong>
                                </div>
                            <?php } if(!\App\Auth::isLogged()){?>

                            <div class="form-group">
                                <label for="password">Heslo</label>
                                <input class="form-control" type="password" name="password" id="password" minlength="6" <?php if($data['password']!=null){?> value="<?=$data['password']?>" <?php }?> required>
                            </div>
                        <?php if ($data['errorPassword'] != null) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['errorPassword'] ?></strong>
                            </div>
                        <?php }} ?>
                        <div class="row">
                            <div class="col-4">
                                <label for="checkbox">Dni stráženia</label>
                            </div>
                            <div class="col-4">
                                <input type="checkbox" id="monday" name="monday" value="PON" <?php if ($data['monday']!=null) {?> checked <?php } ?> >
                                <label for="monday">Pondelok</label><br>
                                <input type="checkbox" id="tuesday" name="tuesday" value="UT" <?php if ($data['tuesday']!=null) {?> checked <?php } ?> >
                                <label for="tuesday">Utorok</label><br>
                                <input type="checkbox" id="wednesday" name="wednesday" value="ST" <?php if ($data['wednesday']!=null) {?> checked <?php } ?>>
                                <label for="wednesday">Streda</label><br>
                                <input type="checkbox" id="thursday" name="thursday" value="ŠT" <?php if ($data['thursday']!=null) {?> checked <?php } ?>>
                                <label for="thursday">Štvrtok</label><br>
                            </div>
                            <div class="col-4">
                                <input type="checkbox" id="friday" name="friday" value="PIA" <?php if ($data['friday']!=null) {?> checked <?php } ?>>
                                <label for="friday">Piatok</label><br>
                                <input type="checkbox" id="saturday" name="saturday" value="SOB" <?php if ($data['saturday']!=null) {?> checked <?php } ?>>
                                <label for="saturday">Sobota</label><br>
                                <input type="checkbox" id="sunday" name="sunday" value="NED" <?php if ($data['sunday']!=null) {?> checked <?php } ?>>
                                <label for="sunday">Nedeľa</label><br><br>
                            </div>
                        </div>
                        <?php if ($data['errorDays'] != null) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['errorDays'] ?></strong>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="city">Mesto stráženia</label>
                            <input type="text" class="form-control" name="city" id="city" <?php if($data['city']!=null){?> value="<?=$data['city']?>" <?php }?> required>
                            <div id="errorCity"></div>
                        </div>
                        <?php if ($data['errorCity'] != null) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['errorCity'] ?></strong>
                            </div>
                        <?php } ?>
                        <div class="form-row">
                            <label for="payment">Cena za stráženie na deň:</label>
                            <input type="number" class="form-control" name="payment" id="payment" step="0.1" <?php if($data['payment']!=null){?> value="<?=$data['payment']?>" <?php }?> required>
                        </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Odoslať</button>
                            </div>
                    </form>
                </article>
                <div class="border-top card-body text-center">Máte účet? <a href="?c=auth&a=loginForm">Prihlásiť sa</a></div>
            </div>
        </div>

    </div>


</div>


<script src="public/javaScript.js"></script>