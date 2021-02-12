<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacto".
 *
 * @property int $id
 * @property string $nome
 * @property string $assunto
 * @property string $corpo
 * @property string $email
 * @property int $id_Categoria
 * @property int $id_Utente
 * @property string $data_envio
 * @property string|null $data_respondido
 * @property int|null $respondido
 *
 * @property Categorias $categoria
 * @property Profile $utente
 */
class Contacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'assunto', 'corpo', 'email', 'id_Categoria', 'id_Utente', 'data_envio'], 'required'],
            [['id_Categoria', 'id_Utente', 'respondido'], 'integer'],
            [['data_envio', 'data_respondido'], 'safe'],
            [['nome', 'assunto', 'corpo', 'email'], 'string', 'max' => 255],
            [['id_Categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['id_Categoria' => 'id']],
            [['id_Utente'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_Utente' => 'id']],
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
            'assunto' => 'Assunto',
            'corpo' => 'Corpo',
            'email' => 'Email',
            'id_Categoria' => 'Id Categoria',
            'id_Utente' => 'Id Utente',
            'data_envio' => 'Data Envio',
            'data_respondido' => 'Data Respondido',
            'respondido' => 'Respondido',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'id_Categoria']);
    }

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id_Utente']);
    }
}
