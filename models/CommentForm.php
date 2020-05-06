<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 06.05.2020
     * Time: 13:07
     */

    namespace app\models;


    use Yii;
    use yii\base\Model;
    use Carbon\Carbon;

    class CommentForm extends Model
    {
        public $comment;


        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                    [['comment'], 'required'],

            ];
        }

        public function saveComment($acticle_id)
        {
            $comment=new Comment();
            $comment->text=$this->comment;
            $comment->user_id=Yii::$app->user->id;
            $comment->article_id=$acticle_id;
            $comment->date=Carbon::now();
            $comment->save(false);
        }

    }