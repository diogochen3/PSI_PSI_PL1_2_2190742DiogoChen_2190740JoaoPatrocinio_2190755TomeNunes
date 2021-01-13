<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "receitas".
 *
 * @property int $id
 * @property string $Nome_medicamento
 * @property int $quantidade
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
            [['Nome_medicamento', 'quantidade'], 'required'],
            [['quantidade'], 'integer'],
            [['Nome_medicamento'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Nome_medicamento' => 'Nome Medicamento',
            'quantidade' => 'Quantidade',
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
