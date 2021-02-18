<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "especialidade".
 *
 * @property int $id
 * @property string $Name
 *
 * @property Marcacao[] $marcacaos
 */
class Especialidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especialidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Marcacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaos()
    {
        return $this->hasMany(Marcacao::className(), ['id_especialidade' => 'id']);
    }
}
