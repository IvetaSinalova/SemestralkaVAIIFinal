<?php /** @var Array $data */ ?>

<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mt-2">Položiť otázku</h4>
        </div>
        <div class="card-body">
            <form method="post" action="?c=home&a=publicQuestion" enctype="multipart/form-data" id="addQuestion">
                <input type="hidden" name="question_id" id="question_id" <?php if($data['question']){ ?> value="<?=$data['question']->getId() ?>" <?php }?>>
                <div class="row">
                    <div class="col-12 align-items-center">
                        <div class="form-group">
                            <label for="title">Nadpis</label>
                            <input type="text" name="title" id="title" class="form-control" <?php if($data['question']){ ?> value="<?=$data['question']->getTitle() ?>" <?php }?> required>
                            <div id="errorTitle"></div>
                        </div>
                        <?php if ($data['errorTitle'] != null) { ?>
                            <div>
                                <div class="alert errorMessage alert-danger alert-dismissible">
                                    <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?= $data['errorTitle'] ?></strong>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div role="textbox">
                        <div class="md-form">
                            <label for="text">Popis</label>
                            <textarea id="text" name="text" class="md-textarea form-control" rows="3" cols="12" <?php if($data['question']){ ?> placeholder="<?=$data['question']->getText()?>" <?php }?> required></textarea>
                        </div>
                    </div>

                </div>
                <div>

                    <?php if ($data['error'] != null) { ?>
                    <div>
                            <div class="alert errorMessage alert-danger alert-dismissible">
                                <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['error'] ?></strong>
                            </div>
                    </div>
                    <?php } ?>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn-card btn-block">Odoslať</button>
                </div>
        </form>
    </div>
</div>
</div>
