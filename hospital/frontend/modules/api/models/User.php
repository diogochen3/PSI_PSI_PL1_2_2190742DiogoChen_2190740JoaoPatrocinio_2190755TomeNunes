<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property int $is_medico
 *
 * @property Consultas[] $consultas
 * @property Consultas[] $consultas0
 * @property Diagnostico[] $diagnosticos
 * @property Diagnostico[] $diagnosticos0
 * @property Marcacao[] $marcacaos
 * @property Marcacao[] $marcacaos0
 * @property MedicoEspecialidade[] $medicoEspecialidades
 * @property Profile $profile
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'is_medico'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'is_medico' => 'Is Medico',
        ];
    }

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consultas::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[Consultas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas0()
    {
        return $this->hasMany(Consultas::className(), ['id_utente' => 'id']);
    }

    /**
     * Gets query for [[Diagnosticos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosticos()
    {
        return $this->hasMany(Diagnostico::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[Diagnosticos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosticos0()
    {
        return $this->hasMany(Diagnostico::className(), ['id_utente' => 'id']);
    }

    /**
     * Gets query for [[Marcacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaos()
    {
        return $this->hasMany(Marcacao::className(), ['id_Medico' => 'id']);
    }

    /**
     * Gets query for [[Marcacaos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaos0()
    {
        return $this->hasMany(Marcacao::className(), ['id_Utente' => 'id']);
    }

    /**
     * Gets query for [[MedicoEspecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicoEspecialidades()
    {
        return $this->hasMany(MedicoEspecialidade::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id']);
    }
}
