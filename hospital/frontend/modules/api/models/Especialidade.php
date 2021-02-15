<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "especialidade".
 *
 * @property int $id
 * @property int $Name
 *
 * @property Marcacao[] $marcacaos
 * @property MedicoEspecialidade[] $medicoEspecialidades
 * @property Profile[] $medicos
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
            [['Name'], 'integer'],
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

    /**
     * Gets query for [[MedicoEspecialidades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicoEspecialidades()
    {
        return $this->hasMany(MedicoEspecialidade::className(), ['id_especialidade' => 'id']);
    }

    /**
     * Gets query for [[Medicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicos()
    {
        return $this->hasMany(Profile::className(), ['id' => 'id_medico'])->viaTable('medico_especialidade', ['id_especialidade' => 'id']);
    }
}
