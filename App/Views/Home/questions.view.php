<?php /** @var Array $data */ ?>

<div class="container">
    <br>

    <div class="col-lg-12">
        <div class="forum-container">

                <?php foreach($data['questions'] as $question){?>
            <div class="forum-item">
                    <div class="row forum">
                        <div class="col-12 col-md-1 text-center">
                            <?php if (\App\Forum::getAuthorProfilePicture($question->getIdAuthor())) { ?>
                                <img class="img_forum_posts" src="<?= \App\Config\Configuration::UPLOAD_DIR . \App\Forum::getAuthorProfilePicture($question->getIdAuthor())?>" alt="profile_picture_<?= \App\Forum::getAuthorName($question->getIdAuthor()) ?>">
                            <?php } else { ?>
                                <img class="img_forum_posts" src="<?= \App\Config\Configuration::DEFAULET_PROFILE_PICTURE ?>" alt="avatar">
                            <?php } ?>
                        </div>
                        <div class="col-12 col-md-9" id="QuestionTitle">
                            <div class="forum-text">
                                <form method="post" action="?c=home&a=getQuestion" id="forum">
                                    <input type="hidden" value="<?=$question->getId() ?>" name="id" class="id">
                                    <button type="submit" class="transparent"><?=$question->getTitle()?></button>
                                </form>
                            </div>
                            <div class="forum-sub-title" id="QuestionAuthor">
                                <?=\App\Forum::getAuthorName($question->getIdAuthor())?>
                            </div>
                        </div>


                        <div class="col-12 col-md-2 forum-info justify-content-center">
                            <span class="forum-text">
                                Počet komentárov: <?=$question->getNumOfAnswers()?>
                            </span>


                            <?php if (\App\Auth::getId() == $question->getIdAuthor()) { ?>
                                <div class="row">
                                    <div class="col-12 col-md-1">
                                        <form method="post" action="?c=home&a=deleteQuestion">
                                            <input type="hidden" value="<?=$question->getId() ?>" name="id_question" class="id_question">
                                            <button class="transparent" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-md-1">
                                        <form method="post" action="?c=home&a=editQuestion">
                                            <input type="hidden" value="<?=$question->getId() ?>" name="id_question" class="id_question">
                                            <button class="transparent" type="submit"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
            </div>
                <?php } ?>



        </div>

    </div>

</div>