<?php
namespace backend\models;

use common\models\MedicoEspecialidade;
use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Profile;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $fname;
    public $lname;
    public $phone_number;
    public $NIF;
    public $Address;
    public $Birth_date;
    public $gender;
    public $postal_code;
    public $id_especialidade;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['fname', 'trim'],
            ['fname', 'required'],
            ['fname', 'string', 'min' => 2, 'max' => 255],

            ['lname', 'trim'],
            ['lname', 'required'],
            ['lname', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['Address', 'trim'],
            ['Address', 'required'],
            ['Address', 'string', 'max' => 255],

            ['postal_code', 'trim'],
            ['postal_code', 'required'],
            ['postal_code', 'string', 'max' => 40],

            ['NIF', 'trim'],
            ['NIF', 'required'],
            ['NIF', 'integer'],

            ['gender', 'trim'],
            ['gender', 'required'],
            ['gender', 'string'],

            ['phone_number', 'trim'],
            ['phone_number', 'required'],
            ['phone_number', 'integer'],

            ['Birth_date', 'trim'],
            ['Birth_date', 'required'],
            ['Birth_date', 'string'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],




        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {

        if ($this->validate()) {
            $user = new User();

            $profile = new Profile();
            $user->username = $this->fname;
            $user->email = $this->email;
            $profile->Email = $this->email;
            $profile->First_name = $this->fname;
            $profile->Last_name = $this->lname;
            $profile->Phone_number = $this->phone_number;
            $profile->NIF = $this->NIF;
            $profile->Address = $this->Address;
            $profile->gender = $this->gender;
            $profile->postal_code = $this->postal_code;
            $profile->Birth_date = $this->Birth_date;

            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->save(false);
            $profile->id = $user->getId();
            $profile->save(false);
            $especialidadelist = $_POST['SignupForm']['id_especialidade'];
            foreach ($especialidadelist as $item) {
                $medico_Especialidade = new MedicoEspecialidade();
                $medico_Especialidade->id_especialidade = $item;
                $medico_Especialidade->id_medico = $profile->id;
                $medico_Especialidade->save();
            }

            // the following three lines were added:
            $auth = \Yii::$app->authManager;
            $utenteRole = $auth->getRole('medico');
            $auth->assign($utenteRole, $user->getId());

            return $user && $this->sendEmail($user) && $profile;
        }

        return null;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
