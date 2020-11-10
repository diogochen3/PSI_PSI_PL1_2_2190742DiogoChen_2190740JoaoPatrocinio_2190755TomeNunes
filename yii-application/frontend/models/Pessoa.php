<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $id
 * @property string $nome
 * @property int $idade
 * @property string $morada
 * @property string $nif
 * @property string $email
 */
class Pessoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'idade', 'morada', 'nif', 'email'], 'required'],
            [['idade'], 'integer'],
            [['nome', 'morada', 'email'], 'string', 'max' => 80],
            [['nif'], 'string', 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'idade' => 'Idade',
            'morada' => 'Morada',
            'nif' => 'Nif',
            'email' => 'Email',
        ];
    }
}
