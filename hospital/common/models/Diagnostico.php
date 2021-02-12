<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diagnostico".
 *
 * @property int $id
 * @property string $descricao
 * @property string $date
 * @property string $situacao
 * @property int $id_medico
 * @property int $id_utente
 *
 * @property Profile $medico
 * @property Profile $utente
 */
class Diagnostico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnostico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'date', 'situacao', 'id_medico', 'id_utente'], 'required'],
            [['date'], 'safe'],
            [['id_medico', 'id_utente'], 'integer'],
            [['descricao', 'situacao'], 'string', 'max' => 255],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_medico' => 'id']],
            [['id_utente'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_utente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'date' => 'Date',
            'situacao' => 'Situacao',
            'id_medico' => 'Id Medico',
            'id_utente' => 'Id Utente',
        ];
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedico()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id_medico']);
    }

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id_utente']);
    }
}
