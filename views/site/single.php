<?php

    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <article class="post">
                <div class="post-thumb">
                    <img src="<?= $article->getImage() ?>"/>
                </div>
                <div class="post-content">

                    <header class="entry-header text-center text-uppercase">
                        <h1 class="entry-title"><?= $article->title ?></h1>
                    </header>
                    <div class="entry-content">
                        <?= $article->content ?>
                    </div>
                </div>
            </article>

            <?php $form = ActiveForm::begin([
                    'action' => ['comment', 'id' => $article->id],
                    'id' => 'comment-form',
                    'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ],
            ]); ?>

            <?= $form->field($commentForm, 'comment')->textInput(['autofocus' => true])->label() ?>


            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Post Comment',
                            ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


            <b>Комментарии:</b> <br>
            <? if (!empty($comments)) { ?>
                <? foreach ($comments as $comment): ?>
                    <span class="border border-primary">
                        <h5><b><?= $comment->user->name ?></b></h5>
                    <small><?= $comment->date ?></small><br>
                        <?= $comment->text ?>
                    </span>
                <? endforeach; ?>
            <? } ?>
        </div>
    </div>
</div>
<!-- end main content-->