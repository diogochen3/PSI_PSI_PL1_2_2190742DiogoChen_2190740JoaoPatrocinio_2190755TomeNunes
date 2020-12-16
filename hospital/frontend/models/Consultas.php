<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "consultas".
 *
 * @property int $id
 * @property int $id_utente
 * @property int $id_medico
 *
 * @property Marcacao $id0
 * @property User $medico
 * @property User $utente
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
            [['id', 'id_utente', 'id_medico'], 'required'],
            [['id', 'id_utente', 'id_medico'], 'integer'],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Marcacao::className(), 'targetAttribute' => ['id' => 'id']],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_medico' => 'id']],
            [['id_utente'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_utente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_utente' => 'Id Utente',
            'id_medico' => 'Id Medico',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Marcacao::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedico()
    {
        return $this->hasOne(User::className(), ['id' => 'id_medico']);
    }

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(User::className(), ['id' => 'id_utente']);
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
