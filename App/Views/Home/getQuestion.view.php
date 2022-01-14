<?php /** @var Array $data */ ?>

<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-11">
                    <h4 class="card-title mt-2"><?= $data['question']->getTitle() ?></h4>
                </div>

            <?php if (\App\Auth::getId() == $data['question']->getIdAuthor()) { ?>
                    <div class="col-md-1">
                        <form method="post" action="?c=home&a=deleteQuestion">
                            <input type="hidden" value="<?=$data['question']->getId() ?>" name="id_question" class="id_question">
                            <button class="transparent" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <form method="post" action="?c=home&a=editQuestion">
                            <input type="hidden" value="<?=$data['question']->getId() ?>" name="id_question" class="id_question">
                            <button class="transparent" type="submit"><i class="fas fa-edit"></i></button>
                        </form>
                    </div>

            <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="text-center d-flex flex-column align-items-center">
                        <img src="<?= \App\Forum::getAuthorProfilePicture($data['question']->getIdAuthor()) != null ? \App\Config\Configuration::UPLOAD_DIR .\App\Forum::getAuthorProfilePicture($data['question']->getIdAuthor()) : \App\Config\Configuration::DEFAULT_DOG_PICTURE ?>"
                             alt="dog" class="crop">
                    </div>
                </div>
                <div class="col-12 col-md-8 align-items-center">
                    <div class="row">
                        <?= $data['question']->getText() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content forum-container">
                        <div class="forum-item active">
                            <?php foreach($data['answers'] as $answer){?>
                                <div class="row">
                                    <div class="col-1 text-center">
                                        <?php if (\App\Forum::getAuthorProfilePicture($answer->getAuthorId()) ) { ?>
                                            <img class="img_forum_posts" src="<?= \App\Config\Configuration::UPLOAD_DIR . \App\Forum::getAuthorProfilePicture($answer->getAuthorId()) ?>" alt="profile_picture_<?= \App\Forum::getAuthorName($answer->getAuthorId())  ?>">
                                        <?php } else { ?>
                                            <img class="img_forum_posts" src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>" alt="avatar">
                                        <?php } ?>
                                    </div>
                                    <div class="col-10">
                                        <h6>
                                            <?=\App\Forum::getAuthorName($answer->getAuthorId())?>
                                        </h6>
                                        <p>
                                            <?=$answer->getText() ?>
                                        </p>
                                    </div>
                                    <div class=" col-1 forum-info">
                                <?=$answer->getLikes()?>
                                        <div>
                                            <?php if(\App\Forum::alreadyLikedAnswer(\App\Auth::getId(),$answer->getId())!=-1){ ?>
                                            <form method="post" action="?c=home&a=removeLike" id="removeLike">
                                                <input type="hidden" value="<?=$answer->getId() ?>" name="answer_id" class="answer_id">
                                                <input type="hidden" value="<?=$data['question']->getId()?>" name="question_id" class="question_id">
                                                <button type="submit" class="transparent"><small><i class="fas fa-thumbs-down"></i></small></button>
                                            </form>
                                            <?php } else{?>
                                                <form method="post" action="?c=home&a=addLike" id="addLike">
                                                    <input type="hidden" value="<?=$answer->getId() ?>" name="answer_id" class="answer_id">
                                                    <input type="hidden" value="<?=$data['question']->getId()?>" name="question_id" class="question_id">
                                                    <button type="submit" class="transparent"><small><i class="fas fa-thumbs-up"></i></small></button>
                                                </form>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>
                        </div>


                    </div>

                </div>
                <form method="post" action="?c=home&a=addAnswer" id="answerForm">
                    <input type="hidden" name="question_id" id="question_id" value="<?=$data['question']->getId()?>">
                    <div class="row">
                        <div role="textbox">
                            <div class="md-form">
                                <textarea id="text" name="text" class="md-textarea form-control" rows="3" col="12" required></textarea>
                            </div>
                            <?php if ($data['error'] != null) { ?>
                                <br>
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?= $data['error'] ?></strong>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                    <button id="btn" type="submit" class="btn">Odpovedať</button>
                    <div id="errorRating"></div>
                </form>
            </div>
        </div>
    </div>
</div>
