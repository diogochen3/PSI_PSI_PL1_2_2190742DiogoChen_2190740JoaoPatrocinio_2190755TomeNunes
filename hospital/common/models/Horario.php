<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "horario".
 *
 * @property int $id
 * @property string $tempo
 * @property int $usado
 * @property int $id_medico
 *
 * @property Profile $medico
 * @property Marcacao $marcacao
 */
class Horario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tempo', 'id_medico'], 'required'],
            [['tempo'], 'safe'],
            [['usado', 'id_medico'], 'integer'],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_medico' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tempo' => 'Tempo',
            'usado' => 'Usado',
            'id_medico' => 'Id Medico',
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
     * Gets query for [[Marcacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacao()
    {
        return $this->hasOne(Marcacao::className(), ['id' => 'id']);
    }

}
