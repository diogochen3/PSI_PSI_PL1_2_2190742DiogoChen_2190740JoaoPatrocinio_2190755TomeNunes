<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "receitas".
 *
 * @property int $id
 * @property int $cod_acesso
 * @property int $cod_dispensa
 * @property string $data_emissao
 * @property int $id_consulta
 *
 * @property ReceitaMedicamento[] $receitaMedicamentos
 * @property Medicamento[] $medicamentos
 * @property Consultas $consulta
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
            [['cod_acesso', 'cod_dispensa', 'data_emissao', 'id_consulta'], 'required'],
            [['cod_acesso', 'cod_dispensa', 'id_consulta'], 'integer'],
            [['data_emissao'], 'safe'],
            [['id_consulta'], 'exist', 'skipOnError' => true, 'targetClass' => Consultas::className(), 'targetAttribute' => ['id_consulta' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cod_acesso' => 'Cod Acesso',
            'cod_dispensa' => 'Cod Dispensa',
            'data_emissao' => 'Data Emissao',
            'id_consulta' => 'Id Consulta',
        ];
    }

    /**
     * Gets query for [[ReceitaMedicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitaMedicamentos()
    {
        return $this->hasMany(ReceitaMedicamento::className(), ['id_receita' => 'id']);
    }

    /**
     * Gets query for [[Medicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentos()
    {
        return $this->hasMany(Medicamento::className(), ['id' => 'id_medicamento'])->viaTable('receita_medicamento', ['id_receita' => 'id']);
    }

    /**
     * Gets query for [[Consulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsulta()
    {
        return $this->hasOne(Consultas::className(), ['id' => 'id_consulta']);
    }
}
