<?php /** @var Array $data */ ?>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Upraviť profil</h4>
                </header>
                <article class="card-body">
                    <form id="editProfileForm" method="post" enctype="multipart/form-data" action="?c=home&a=changeProfileInfo">
                        <div class="text-center">
                            <?php $user = \App\Models\User::getOne(\App\Auth::getId());
                            if ($user->getProfilePicture() != null) { ?>
                                <img src=<?= \App\Config\Configuration::UPLOAD_DIR . $user->getProfilePicture() ?>
                                     alt="profile_picture_<?= $user->getName() . "_" . $user->getLastName() ?>"
                                     class="crop img-thumbnail"/>
                            <?php } else { ?>
                                <img class="crop img-thumbnail" src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>" alt="avatar"/>
                            <?php } ?>
                            <input type="file" class="file-upload" name="profile_picture" id="profile_picture">
                            </hr><br>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="name">Meno</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       value="<?= $user->getName() ?>">
                            </div>
                            <div class="col form-group">
                                <label for="last_name">Priezvisko</label>
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                       value="<?= $user->getLastName() ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" placeholder="" name="email" id="email"
                                   value="<?= $user->getEmail() ?>">
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="checkbox">Dni venčenia</label>
                            </div>
                            <div class="col-4">
                                <input type="checkbox" id="monday" name="monday" value="PON">
                                <label for="monday">Pondelok</label><br>
                                <input type="checkbox" id="tuesday" name="tuesday" value="UT">
                                <label for="tuesday">Utorok</label><br>
                                <input type="checkbox" id="wednesday" name="wednesday" value="STR">
                                <label for="wednesday">Streda</label><br>
                                <input type="checkbox" id="thursday" name="thursday" value="ŠTV">
                                <label for="thursday">Štvrtok</label><br>
                            </div>
                            <div class="col-4">
                                <input type="checkbox" id="friday" name="friday" value="PIA">
                                <label for="friday">Piatok</label><br>
                                <input type="checkbox" id="saturday" name="saturday" value="SOB">
                                <label for="saturday">Sobota</label><br>
                                <input type="checkbox" id="sunday" name="sunday" value="NED">
                                <label for="sunday">Nedeľa</label><br><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cities">Mestá venčenia</label>
                            <input type="text" class="form-control" name="cities" id="cities" placeholder="mesto1, mesto2,.."
                                   value="<?= $user->getCities() ?>">
                            <div id="errorCities"></div>
                        </div>
                        <div class="form-row">
                            <label for="payment">Cena za venčenie</label>
                            <input type="number" class="form-control" name="payment" id="payment" max="3" min="0" placeholder="0-3"
                                   value="<?= $user->getPayment() ?>">
                        </div>

                        <?php if ($data['error'] != null) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['error'] ?></strong>
                            </div>
                        <?php } ?>
                        <div class="form-row">
                            <button type="submit" class="btn btn-block"> Upraviť</button>
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </div>
</div>

<script src="public/javaScript.js"></script>
