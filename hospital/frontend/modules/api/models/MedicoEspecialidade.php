<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "medico_especialidade".
 *
 * @property int $id_medico
 * @property int $id_especialidade
 *
 * @property Especialidade $especialidade
 * @property Profile $medico
 */
class MedicoEspecialidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medico_especialidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_medico', 'id_especialidade'], 'required'],
            [['id_medico', 'id_especialidade'], 'integer'],
            [['id_medico', 'id_especialidade'], 'unique', 'targetAttribute' => ['id_medico', 'id_especialidade']],
            [['id_especialidade'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::className(), 'targetAttribute' => ['id_especialidade' => 'id']],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_medico' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_medico' => 'Id Medico',
            'id_especialidade' => 'Id Especialidade',
        ];
    }

    /**
     * Gets query for [[Especialidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidade()
    {
        return $this->hasOne(Especialidade::className(), ['id' => 'id_especialidade']);
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedico()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id_medico']);
    }
}
