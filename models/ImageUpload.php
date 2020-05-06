<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 06.05.2020
     * Time: 9:21
     */

    namespace app\models;


    use Yii;
    use yii\base\Model;
    use yii\web\UploadedFile;

    class ImageUpload extends Model
    {
        public $image;

        public function rules()
        {
            return [
                    [['image'], 'required'],
                    [['image'], 'file', 'extensions' => 'jpg,png']
            ];
        }


        public function uploadFile(UploadedFile $file)
        {
            $this->image = $file;
            if ($this->validate()) {
                $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
                $file->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $filename);

                return $filename;
            }
        }

    }