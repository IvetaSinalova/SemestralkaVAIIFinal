<?php /** @var Array $data */?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script defer src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="container profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <?php if ($data['profile_picture'] != null) { ?>
                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $data['profile_picture'] ?>"
                         alt="profile_picture_<?= $data['name'] . "_" . $data['last_name'] ?>"
                    />
                <?php } else { ?>
                    <img src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>" alt="avatar"/>
                <?php } ?>
                <?php if (\App\Auth::getId() == $data['id']) { ?>
                        <a class="edit-profile-a" href="?c=home&a=editProfile">Upraviť profil</a>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>
                    <?= $data['name'] . " " . $data['last_name'] ?>
                </h5>

                <?php $user = \App\Models\User::getOne($data['id']);?>
                    <p class="profile-rating">Hodnotenie : <span><?= $user->getRating() == -1 ? '?' : $user->getRating() . '/5' ?></span></p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aboutMe" role="tab"
                           aria-controls="home" aria-selected="true">O mne</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#reviews" role="tab"
                           aria-controls="profile" aria-selected="false">Recenzie</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="aboutMe" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Meno:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['name'] . " " . $data['last_name'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Kontakt:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['email'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Dátum narodenia:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['bday'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Mestá venčenia:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['cities'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Dni venčenia:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['days_available'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Cena za venčenie:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['payment'] != 0 && $data['payment']!=null ? $data['payment'] . "€/hod" : "Zadarmo" ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Dátum registrácie:</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $data['registration_date'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="profile-tab">
                    <?php

                    if ($user->getRating() == -1) { ?>
                    <span>Užívateľ nemá zatiaľ žiadne recenzie.</span>
                    <?php }
                    else {
                    foreach (\App\Models\Review::getAll() as $review) {
                        $receiver = \App\Models\User::getOne($review->getReceiverId());
                        if ($receiver->getId() == $data['id']) {
                            $writer = \App\Models\User::getOne($review->getWriterId()); ?>
                            <div class="row">
                                <div class="col-md-11">
                                    <p><?= $review->getRating() . '/5' ?></p>
                                    <h6><?= $review->getText() ?></h6>
                                </div>
                                <?php if (\App\Auth::getId() == $writer->getId()) { ?>
                                    <div class="col-md-1">
                                        <form method="post" enctype="multipart/form-data" action="?c=home&a=editReview">
                                            <input name="review_id" id="review_id" value="<?= $review->getId() ?>"
                                                   type="hidden">
                                            <button class="btn-review-edit" type="submit"><i class="fas fa-edit"></i></button>
                                        </form>
                                        <form method="post" enctype="multipart/form-data"
                                              action="?c=home&a=deleteReview">
                                            <input name="review_id" id="review_id" value="<?= $review->getId() ?>"
                                                   type="hidden">
                                            <button class="btn-review-edit" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        -<?= $writer->getName() . ' ' . $writer->getLastName() . ' ' . $review->getDate() ?></p>
                                </div>
                            </div>
                        <?php }
                    } }?>
                    <?php if (\App\Auth::getId() != $data['id'] && \App\Auth::isLogged()) { ?>
                    <form method="post" action="?c=home&a=addReview" id="review">
                            <input type="hidden" id="receiver_id" name="receiver_id" value="<?= $data['id'] ?>">
                            <input type="hidden" id="writer_id" name="writer_id" value="<?= \App\Auth::getId() ?>">
                            <div class="row reviewSettings">
                                <div class="col-9" role="textbox">
                                    <div class="md-form">
                                        <textarea id="text" name="text" class="md-textarea form-control" rows="3"
                                                  col="12"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row reviewSettings">
                                <div class="col-9">
                                    <input type="number" name="rating" id="rating" placeholder="1-5" max="5" min="0" required>
                                </div>
                            </div>
                            <button id="btn-review" type="submit" class="btn">Pridať recenziu</button>
                        <div id="errorRating"></div>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


