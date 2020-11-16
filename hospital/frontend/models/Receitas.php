<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receitas".
 *
 * @property int $id
 * @property int $Name
 *
 * @property ReceitasConsultas[] $receitasConsultas
 * @property Consultas[] $consultas
 */
class Receitas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receitas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Name'], 'required'],
            [['id', 'Name'], 'integer'],
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
            'Name' => 'Name',
        ];
    }

    /**
     * Gets query for [[ReceitasConsultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitasConsultas()
    {
        return $this->hasMany(ReceitasConsultas::className(), ['id_receitas' => 'id']);
    }

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consultas::className(), ['id' => 'id_consultas'])->viaTable('receitas_consultas', ['id_receitas' => 'id']);
    }
}
