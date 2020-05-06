<?php

    namespace app\models;

    use Yii;
    use yii\base\Model;
    use yii\base\Security;
    use yii\base\CSecurityManager;

    class SignupForm extends Model
    {
        public $username;
        public $name;
        public $email;
        public $password;
        public $fio;
        public $phone;
        public $password_repeat;
        public $verifyCode;

        public function rules()
        {
            return [
                    [['username', 'name', 'email', 'password'], 'required'],
                    ['password_repeat', 'required'],
                    [
                            'password_repeat',
                            'compare',
                            'compareAttribute' => 'password',
                            'message' => "Passwords don't match"
                    ],
                    [['email'], 'email'],
                    [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
                    [['username'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'username'],
            ];
        }

        public function attributes()
        {
            return [
                    'id',
                    'username',
                    'name',
                    'password',
                    'name',
                    'email',
            ];
        }

        /**
         * @return array customized attribute labels
         */
        public function attributeLabels()
        {
            return [
                    'verifyCode' => 'Verification Code',
            ];
        }


        public function signup()
        {
            if ($this->validate()) {
                $user = new User();
            //    $user->attributes = $this->attributes;
                $user->name=$this->name;
                $user->username=$this->username;
                $user->email=$this->email;
                $user->password = $this->password;
                //   $user->emailToken = Yii::$app->security->generateRandomString(32);
                // $this->endConfurmEmail($user->mail, $user->emailToken);

                $user->create();
                return $user;
            }
            return null;
        }

        public function sendConfurmEmail($email, $token)
        {


            Yii::$app->mailer->compose(['html' => '@app/mail/html'], ['token' => $token])
                    ->setFrom('sakura-testmail@sakura-city.info')
                    ->setTo($email)
                    ->setSubject('Please confurm you email')
                    ->send();
        }

    }