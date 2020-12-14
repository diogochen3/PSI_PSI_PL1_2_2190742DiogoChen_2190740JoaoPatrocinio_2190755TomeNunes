<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "diagnostico".
 *
 * @property int $id
 * @property string $Descri
 * @property string $date
 * @property string $situacao
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
            [['id', 'Descri', 'date', 'situacao'], 'required'],
            [['id'], 'integer'],
            [['date'], 'safe'],
            [['Descri', 'situacao'], 'string', 'max' => 255],
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
            'Descri' => 'Descri',
            'date' => 'Date',
            'situacao' => 'Situacao',
        ];
    }
}
