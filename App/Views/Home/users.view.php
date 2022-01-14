<?php /** @var Array $data */ ?>

<div class="container post">
    <div class="row justify-content-center">
        <?php foreach ($data['users'] as $user) { ?>
            <div class="col-sm-6 col-md-4">
                <div class="card-content">
                    <div class="card-img">
                        <?php if ($user->getProfilePicture()) { ?>
                            <img class="crop" src="<?= \App\Config\Configuration::UPLOAD_DIR . $user->getProfilePicture() ?>" alt="profile_picture_<?= $user->getName() . " " . $user->getLastName() ?>">
                        <?php } else { ?>
                            <img class="crop" src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>" alt="avatar">
                        <?php } ?>
                        <span><h4><?= $user->getRating() == -1 ? "?" : $user->getRating() . '/5' ?></h4></span>
                    </div>
                    <div class="card-desc text-center">
                        <p><h5><?= $user->getName() . " " . $user->getLastName() ?></h5></p>
                        <p>Cena: <?= $user->getPayment() != 0 ? $user->getPayment() . "€/deň" : "Zadarmo" ?></p>
                        <p>Mesto: <?= $user->getCity() ?></p>
                        <p>Dni: <?= $user->getDaysAvailable() ?></p>
                        <?php if(\App\Auth::isLogged()){?>
                        <form method="post" action="?c=home&a=getProfile">
                            <input type="hidden" name="id" id="id" value="<?= $user->getId() ?>">
                            <button type="submit" class="btn btn-card">
                                Zobraziť profil
                            </button>
                        </form>
                        <?php }?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>








