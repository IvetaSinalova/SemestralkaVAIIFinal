<?php /** @var Array $data */ ?>

<div class="container">
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content forum-container">
                <div class="forum-item active">
                    <?php foreach($data['questions'] as $question){?>
                    <div class="row">
                        <div class="col-1 text-center">
                            <?php if (\App\Forum::getAuthorProfilePicture($question->getIdAuthor())) { ?>
                                <img class="img_forum_posts" src="<?= \App\Config\Configuration::UPLOAD_DIR . \App\Forum::getAuthorProfilePicture($question->getIdAuthor())?>" alt="profile_picture_<?= \App\Forum::getAuthorName($question->getIdAuthor()) ?>">
                            <?php } else { ?>
                                <img class="img_forum_posts" src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>" alt="avatar">
                            <?php } ?>
                        </div>
                        <div class="col-9">
                            <form method="post" action="?c=home&a=getQuestion" id="forum">
                                <input type="hidden" value="<?=$question->getId() ?>" name="id" class="id">
                                <button type="submit" class="transparent"><h6><?=$question->getTitle()?></h6></button>
                            </form>

                            <div class="forum-sub-title">
                                <?=\App\Forum::getAuthorName($question->getIdAuthor())?>
                            </div>
                        </div>
                        <div class=" col-2 forum-info justify-content-center">
                            <span class="views-number">
                                Počet komentárov: <?=$question->getNumOfAnswers()?>
                            </span>
                            <?php if (\App\Auth::getId() == $question->getIdAuthor()) { ?>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <form method="post" action="?c=home&a=deleteQuestion">
                                                <input type="hidden" value="<?=$question->getId() ?>" name="id_question" class="id_question">
                                                <button class="transparent" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-md-1">
                                            <form method="post" action="?c=home&a=editQuestion">
                                                <input type="hidden" value="<?=$question->getId() ?>" name="id_question" class="id_question">
                                                <button class="transparent" type="submit"><i class="fas fa-edit"></i></button>
                                            </form>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>
                        <hr>
                    </div>

                    <?php } ?>
                </div>


            </div>

        </div>
    </div>
</div>