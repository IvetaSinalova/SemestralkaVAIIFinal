<?php /** @var Array $data */ ?>

<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mt-2">Položiť otázku</h4>
        </div>
        <div class="card-body">
            <form method="post" action="?c=home&a=publicQuestion" enctype="multipart/form-data" id="add_dog_walk">
                <input type="hidden" name="question_id" id="question_id" <?php if($data['question']){ ?> value="<?=$data['question']->getId() ?>" <?php }?>>
                <div class="row">
                    <div class="col-12 align-items-center">
                        <div class="form-group">
                            <label for="title">Nadpis</label>
                            <input type="text" name="title" id="title" class="form-control" <?php if($data['question']){ ?> value="<?=$data['question']->getTitle() ?>" <?php }?> required>
                            <div id="errorDate"></div>
                        </div>
                    </div>
                    <div role="textbox">
                        <div class="md-form">
                            <label for="text">Popis</label>
                            <textarea id="text" name="text" class="md-textarea form-control" rows="3" col="12" <?php if($data['question']){ ?> placeholder="<?=$data['question']->getText()?>" <?php }?> required></textarea>
                        </div>
                    </div>
                </div>
                <div>

                    <?php if ($data['error'] != null) { ?>
                        <div>
                            <br>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $data['error'] ?></strong>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-block">Odoslať</button>
                </div>

        </div>
        </form>
    </div>
</div>
</div>