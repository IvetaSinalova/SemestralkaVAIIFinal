<?php /** @var Array $data */ ?>
<br>
<div class="container profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <?php
                if ($data['user']->getProfilePicture() != null) { ?>
                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $data['user']->getProfilePicture() ?>"
                         alt="profile_picture_<?= $data['user']->getName() . "_" . $data['user']->getLastName() ?>"/>
                <?php } else { ?>
                    <img src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>" alt="avatar"/>
                <?php } ?>
                <?php if (\App\Auth::getId() == $data['user']->getId()) { ?>
                    <form method="post" action="?c=home&a=editProfileForm">
                        <input name="id" id="id" value="<?= \App\Auth::getId() ?>" type="hidden">
                        <br>
                        <button class="btn-card" type="submit">Upraviť profil</button>
                    </form>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>
                    <?= $data['user']->getName() . " " . $data['user']->getLastName() ?>
                </h5>
                <?php if (\App\Auth::getId() == $data['user']->getId()) { ?>
                    <form method="post" action="?c=home&a=deleteProfile">
                        <input type="hidden" value="<?= $data['user']->getId() ?>" name="user_id" class="user_id">
                        <button class="transparent" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                <?php } ?>
                <br>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aboutMe" role="tab"
                           aria-selected="true">O mne</a>
                    </li>
                    <li class="nav-item">
                        <input type="hidden" id="user_id" name="user_id" value="<?= $data['user']->getId() ?>">
                        <a class="nav-link" id="rev-tab" data-toggle="tab" href="#reviews" role="tab"
                           aria-selected="false">Recenzie</a></li>
                </ul>
            </div>
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="aboutMe" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Meno:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['user']->getName() . " " . $data['user']->getLastName() ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>E-mai:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['user']->getEmail() ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Dátum narodenia:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['user']->getBday() ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Mesto stráženia:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['user']->getCity() ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Dni stráženia:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['user']->getDaysAvailable() ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Cena za stráženie:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['user']->getPayment() != 0 ? $data['user']->getPayment() . "€/deň" : "Zadarmo" ?></p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" role="tabpanel" id="reviews" >
                  <!--  <div id="reviews-tab"></div> -->

                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="profile-tab">
                        <?php
                        if ($data['user']->getRating() == -1) { ?>
                            <span>Užívateľ nemá zatiaľ žiadne recenzie.</span>
                        <?php } else {
                            foreach ($data['reviews'] as $review) {?>
                                <div class="row">
                                    <div class="col-md-11">
                                        <p><?= $review->getRating() . '/5' ?></p>
                                        <h6><?= $review->getText() ?></h6>
                                    </div>
                                    <?php if (\App\Auth::getId() == $review->getWriterId()) { ?>
                                        <div class="col-md-1">
                                            <button onclick="deleteReview(this.id)" class="btn-review-edit" id="<?= $review->getId() ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><?= $review->getWriterInfo() ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>

                    <?php if (\App\Auth::getId() != $data['user']->getId() && \App\Auth::isLogged()) { ?>
                       <input type="hidden" id="receiver_id" name="receiver_id" value="<?= $data['user']->getId() ?>">
                        <input type="hidden" id="writer_id" name="writer_id" value="<?= \App\Auth::getId() ?>">
                        <div class="row reviewSettings">
                            <div role="textbox">
                                <div class="md-form">
                                    <textarea id="text" name="text" class="md-textarea form-control" rows="3" cols="12" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row reviewSettings">
                            <div class="col-9">
                                <input type="number" name="rating" id="rating" placeholder="1-5" max="5" min="0"
                                       step="0.1" required>
                            </div>
                        </div>
                        <br>
                        <button id="btn-review" type="submit" class="btn-card">Pridať recenziu</button>
                        <div id="errorRating"></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="public/reviews.js"></script>




