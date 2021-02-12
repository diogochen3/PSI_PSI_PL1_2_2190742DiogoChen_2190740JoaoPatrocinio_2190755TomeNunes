<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $First_name
 * @property string $Last_name
 * @property string $Email
 * @property int $Phone_number
 * @property int $NIF
 * @property string $Address
 * @property string $Birth_date
 * @property string $gender
 * @property string $postal_code
 * @property resource|null $imagem
 * @property int|null $id_medico_familia
 *
 * @property Consultas[] $consultas
 * @property Consultas[] $consultas0
 * @property Contacto[] $contactos
 * @property Diagnostico[] $diagnosticos
 * @property Diagnostico[] $diagnosticos0
 * @property Horario[] $horarios
 * @property Marcacao[] $marcacaos
 * @property Marcacao[] $marcacaos0
 * @property MedicoEspecialidade[] $medicoEspecialidades
 * @property Especialidade[] $especialidades
 * @property User $id0
 * @property Profile $medicoFamilia
 * @property Profile[] $profiles
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'First_name', 'Last_name', 'Email', 'Phone_number', 'NIF', 'Address', 'Birth_date', 'gender', 'postal_code'], 'required'],
            [['id', 'Phone_number', 'NIF', 'id_medico_familia'], 'integer'],
            [['Birth_date'], 'safe'],
            [['gender', 'imagem'], 'string'],
            [['First_name', 'Last_name', 'postal_code'], 'string', 'max' => 20],
            [['Email'], 'string', 'max' => 25],
            [['Address'], 'string', 'max' => 255],
            [['NIF'], 'unique'],
            [['Email'], 'unique'],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
            [['id_medico_familia'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_medico_familia' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'First_name' => 'First Name',
            'Last_name' => 'Last Name',
            'Email' => 'Email',
            'Phone_number' => 'Phone Number',
            'NIF' => 'Nif',
            'Address' => 'Address',
            'Birth_date' => 'Birth Date',
            'gender' => 'Gender',
            'postal_code' => 'Postal Code',
            'imagem' => 'Imagem',
            'id_medico_familia' => 'Id Medico Familia',
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
     * Gets query for [[Contactos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContactos()
    {
        return $this->hasMany(Contacto::className(), ['id_Utente' => 'id']);
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
     * Gets query for [[Horarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHorarios()
    {
        return $this->hasMany(Horario::className(), ['id_medico' => 'id']);
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
     * Gets query for [[Especialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidades()
    {
        return $this->hasMany(Especialidade::className(), ['id' => 'id_especialidade'])->viaTable('medico_especialidade', ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[MedicoFamilia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicoFamilia()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id_medico_familia']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['id_medico_familia' => 'id']);
    }
}
