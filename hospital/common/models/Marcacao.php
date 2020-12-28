<?php

namespace common\models;

use Yii;

use common\models\User;
use frontend\models\Especialidade;

/**
 * This is the model class for table "marcacao".
 *
 * @property int $id
 * @property string $date
 * @property string $tempo
 * @property int $Aceitar
 * @property int $id_especialidade
 * @property int $id_Utente
 * @property int $id_Medico
 *
 * @property Consultas $consultas
 * @property Especialidade $especialidade
 * @property User $medico
 * @property User $utente
 */
class Marcacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marcacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'tempo', 'id_especialidade', 'id_Utente', 'id_Medico'], 'required'],
            [['date', 'tempo'], 'safe'],
            [['Aceitar', 'id_especialidade', 'id_Utente', 'id_Medico'], 'integer'],
            [['id_especialidade'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::className(), 'targetAttribute' => ['id_especialidade' => 'id']],
            [['id_Medico'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_Medico' => 'id']],
            [['id_Utente'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_Utente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'tempo' => 'Tempo',
            'Aceitar' => 'Aceitar',
            'id_especialidade' => 'Id Especialidade',
            'id_Utente' => 'Id Utente',
            'id_Medico' => 'Id Medico',
        ];
    }

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasOne(Consultas::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[Especialidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidade()
    {
        return $this->hasOne(Especialidade::className(), ['id' => 'id_especialidade']);
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedico()
    {
        return $this->hasOne(User::className(), ['id' => 'id_Medico']);
    }

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(User::className(), ['id' => 'id_Utente']);
    }
}
