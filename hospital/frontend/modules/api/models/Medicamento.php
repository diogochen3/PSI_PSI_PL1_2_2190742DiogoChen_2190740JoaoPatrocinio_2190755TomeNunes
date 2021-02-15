<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "medicamento".
 *
 * @property int $id
 * @property string $nome_medicamento
 * @property string $dosagem
 * @property string $forma_farmaceuta
 * @property string $embalagem
 * @property resource|null $CodigoOtico
 *
 * @property ReceitaMedicamento[] $receitaMedicamentos
 * @property Receitas[] $receitas
 */
class Medicamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_medicamento', 'dosagem', 'forma_farmaceuta', 'embalagem'], 'required'],
            [['CodigoOtico'], 'string'],
            [['nome_medicamento', 'dosagem', 'forma_farmaceuta', 'embalagem'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_medicamento' => 'Nome Medicamento',
            'dosagem' => 'Dosagem',
            'forma_farmaceuta' => 'Forma Farmaceuta',
            'embalagem' => 'Embalagem',
            'CodigoOtico' => 'Codigo Otico',
        ];
    }

    /**
     * Gets query for [[ReceitaMedicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitaMedicamentos()
    {
        return $this->hasMany(ReceitaMedicamento::className(), ['id_medicamento' => 'id']);
    }

    /**
     * Gets query for [[Receitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitas()
    {
        return $this->hasMany(Receitas::className(), ['id' => 'id_receita'])->viaTable('receita_medicamento', ['id_medicamento' => 'id']);
    }
}
