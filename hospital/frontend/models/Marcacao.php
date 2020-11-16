<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marcacao".
 *
 * @property int $id
 * @property string $date
 * @property int $id_especialidade
 *
 * @property Consultas[] $consultas
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
            [['id', 'date', 'id_especialidade'], 'required'],
            [['id', 'id_especialidade'], 'integer'],
            [['date'], 'safe'],
            [['id'], 'unique'],
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
            'id_especialidade' => 'Id Especialidade',
        ];
    }

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consultas::className(), ['id_marcacao' => 'id']);
    }
}
