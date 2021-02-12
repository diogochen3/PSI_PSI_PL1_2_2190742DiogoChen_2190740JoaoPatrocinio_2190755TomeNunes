<?php

namespace frontend\models;

use common\models\Contacto;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $id_Categoria;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body','id_Categoria'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function contacto()
    {
        if ($this->validate()) {

            $contacto = new Contacto();

            $contacto->id_Categoria = $this->id_Categoria;
            $contacto->nome = $this->name;
            $contacto->email = $this->email;
            $contacto->assunto = $this->subject;
            $contacto->corpo = $this->body;
            $contacto->id_Utente = Yii::$app->user->getId();
            $datenow = null;
            try {
               $datenow = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            } catch (InvalidConfigException $e) {

            }
            $contacto->data_envio = $datenow;
            $contacto->respondido = 0;
            $contacto->save(false);
            return $contacto;
        }

        return null;
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
