<?php /** @var Array $data */ ?>
<div class="container post">
    <div class="row justify-content-center">
        <?php foreach (\App\Models\User::getAll() as $user) { ?>
            <div class="col-sm-6 col-md-4">
                <div class="card-content">
                    <div class="card-img">
                        <?php if ($user->getProfilePicture()) { ?>
                            <img class="crop"
                                 src="<?= \App\Config\Configuration::UPLOAD_DIR . $user->getProfilePicture() ?>"
                                 alt="profile_picture_<?= $user->getName() . " " . $user->getLastName() ?>">
                        <?php } else { ?>
                            <img class="crop" src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>"
                                 alt="avatar">
                        <?php } ?>
                        <span><h4><?= $user->getRating() == -1 ? "?" : $user->getRating() . '/5' ?></h4></span>
                    </div>
                    <div class="card-desc text-center">
                        <p><h5><?= $user->getName() . " " . $user->getLastName() ?></h5></p>
                        <p>Cena za
                            venčenie: <?= $user->getPayment() != 0 ? $user->getPayment() . "€/hod" : "Zadarmo" ?></p>
                        <p>Mestá venčenia: <?= $user->getCities() ?></p>
                        <p>Dni venčenia: <?= $user->getDaysAvailable() ?></p>
                        <form method="post" action="?c=home&a=someonesProfile">
                            <input type="hidden" name="user_id" id="user_id" value="<?= $user->getId() ?>">
                            <button type="submit" class="btn btn-card">
                                Zobraziť profil
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>








