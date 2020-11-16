<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consultas".
 *
 * @property int $id
 * @property int $id_marcacao
 *
 * @property Marcacao $marcacao
 * @property ReceitasConsultas[] $receitasConsultas
 * @property Receitas[] $receitas
 */
class Consultas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consultas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_marcacao'], 'required'],
            [['id', 'id_marcacao'], 'integer'],
            [['id'], 'unique'],
            [['id_marcacao'], 'exist', 'skipOnError' => true, 'targetClass' => Marcacao::className(), 'targetAttribute' => ['id_marcacao' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_marcacao' => 'Id Marcacao',
        ];
    }

    /**
     * Gets query for [[Marcacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacao()
    {
        return $this->hasOne(Marcacao::className(), ['id' => 'id_marcacao']);
    }

    /**
     * Gets query for [[ReceitasConsultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitasConsultas()
    {
        return $this->hasMany(ReceitasConsultas::className(), ['id_consultas' => 'id']);
    }

    /**
     * Gets query for [[Receitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitas()
    {
        return $this->hasMany(Receitas::className(), ['id' => 'id_receitas'])->viaTable('receitas_consultas', ['id_consultas' => 'id']);
    }
}
