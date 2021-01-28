<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property string $Categoria
 * @property string $Descricao
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Categoria', 'Descricao'], 'required'],
            [['Categoria', 'Descricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Categoria' => 'Categoria',
            'Descricao' => 'Descricao',
        ];
    }
}
