<?php

namespace common\models;



use Yii;

/**
 * This is the model class for table "receitas_consultas".
 *
 * @property int $id_receitas
 * @property int $id_consultas
 *
 * @property Consultas $consultas
 * @property Receitas $receitas
 */

class ReceitasConsultas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receitas_consultas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_receitas', 'id_consultas'], 'required'],
            [['id_receitas', 'id_consultas'], 'integer'],
            [['id_receitas', 'id_consultas'], 'unique', 'targetAttribute' => ['id_receitas', 'id_consultas']],
            [['id_consultas'], 'exist', 'skipOnError' => true, 'targetClass' => Consultas::className(), 'targetAttribute' => ['id_consultas' => 'id']],
            [['id_receitas'], 'exist', 'skipOnError' => true, 'targetClass' => Receitas::className(), 'targetAttribute' => ['id_receitas' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_receitas' => 'Id Receitas',
            'id_consultas' => 'Id Consultas',
        ];
    }

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasOne(Consultas::className(), ['id' => 'id_consultas']);
    }

    /**
     * Gets query for [[Receitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitas()
    {
        return $this->hasOne(Receitas::className(), ['id' => 'id_receitas']);
    }
}
