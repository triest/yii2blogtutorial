<?php

    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <img src="<?= $article->getImage() ?>"/>
                    </div>
                    <div class="post-content">

                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::toRoute([
                                        'site/category',
                                        'id' => $article->category->id
                                ]) ?>"> <?= $article->category->title ?></a></h6>

                            <h1 class="entry-title"><a href="<?= Url::toRoute([
                                        'site/view',
                                        'id' => $article->id
                                ]) ?>"><?= $article->title ?></a></h1>


                        </header>
                        <div class="entry-content">
                            <?= $article->content ?>
                        </div>
                    </div>
                </article>

                <?php $form = ActiveForm::begin([
                        'action' => ['comment', 'id' => $article->id],
                        'id' => 'login-form',
                        'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                ]); ?>

                <?= $form->field($commentForm, 'comment')->textInput(['autofocus' => true])->label('Login') ?>


                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>


                <b>Комментарии:</b> <br>
                <? if (!empty($comments)) { ?>
                    <? foreach ($comments as $comment): ?>
                        <h5><?= $comment->user->name ?></h5>
                        <h5><?= $comment->date ?></h5>
                        <div class="comment-text">
                            <?= $comment->text ?>
                        </div>

                    <? endforeach; ?>
                <? } ?>
            </div>
        </div>
    </div>
    <!-- end main content-->