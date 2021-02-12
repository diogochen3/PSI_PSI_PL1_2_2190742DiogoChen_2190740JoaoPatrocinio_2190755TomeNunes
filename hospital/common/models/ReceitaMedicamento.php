<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "receita_medicamento".
 *
 * @property int $id_medicamento
 * @property int $id_receita
 * @property int $quantidade
 * @property string $posologia
 *
 * @property Medicamento $medicamento
 * @property Receitas $receita
 */
class ReceitaMedicamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receita_medicamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_medicamento', 'id_receita', 'quantidade', 'posologia'], 'required'],
            [['id_medicamento', 'id_receita', 'quantidade'], 'integer'],
            [['posologia'], 'string', 'max' => 255],
            [['id_medicamento', 'id_receita'], 'unique', 'targetAttribute' => ['id_medicamento', 'id_receita']],
            [['id_medicamento'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamento::className(), 'targetAttribute' => ['id_medicamento' => 'id']],
            [['id_receita'], 'exist', 'skipOnError' => true, 'targetClass' => Receitas::className(), 'targetAttribute' => ['id_receita' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_medicamento' => 'Id Medicamento',
            'id_receita' => 'Id Receita',
            'quantidade' => 'Quantidade',
            'posologia' => 'Posologia',
        ];
    }

    /**
     * Gets query for [[Medicamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamento()
    {
        return $this->hasOne(Medicamento::className(), ['id' => 'id_medicamento']);
    }

    /**
     * Gets query for [[Receita]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceita()
    {
        return $this->hasOne(Receitas::className(), ['id' => 'id_receita']);
    }
}
