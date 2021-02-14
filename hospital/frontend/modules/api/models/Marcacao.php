<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "marcacao".
 *
 * @property int $id
 * @property int|null $Aceitar
 * @property int $id_especialidade
 * @property int $id_Utente
 * @property int $id_Medico
 *
 * @property Consultas $consultas
 * @property Especialidade $especialidade
 * @property Horario $id0
 * @property Profile $medico
 * @property Profile $utente
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
            [['id', 'id_especialidade', 'id_Utente', 'id_Medico'], 'required'],
            [['id', 'Aceitar', 'id_especialidade', 'id_Utente', 'id_Medico'], 'integer'],
            [['id'], 'unique'],
            [['id_especialidade'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::className(), 'targetAttribute' => ['id_especialidade' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Horario::className(), 'targetAttribute' => ['id' => 'id']],
            [['id_Medico'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_Medico' => 'id']],
            [['id_Utente'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_Utente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Horario::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedico()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id_Medico']);
    }

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id_Utente']);
    }
}
