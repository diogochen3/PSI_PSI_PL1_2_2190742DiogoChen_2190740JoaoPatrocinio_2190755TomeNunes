<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "horario".
 *
 * @property int $id
 * @property string $tempo
 * @property int $id_marcacao
 *
 * @property Marcacao $marcacao
 */
class Horario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tempo', 'id_marcacao'], 'required'],
            [['id', 'id_marcacao'], 'integer'],
            [['tempo'], 'safe'],
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
            'tempo' => 'Tempo',
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

    public function enviar($id)
    {
        $horario = new Horario();

        $horario->tempo = $this->tempo;
        $horario->id_marcacao = $id;
        $horario->save(false);
    }
}
