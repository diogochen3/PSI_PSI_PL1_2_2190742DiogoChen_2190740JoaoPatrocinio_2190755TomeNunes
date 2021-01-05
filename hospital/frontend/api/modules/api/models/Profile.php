<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $First_name
 * @property string $Last_name
 * @property string $Email
 * @property int $Phone_number
 * @property int $NIF
 * @property string|null $Address
 * @property string|null $Birth_date
 * @property string|null $gender
 * @property string|null $postal_code
 * @property int $is_medico
 *
 * @property User $id0
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'First_name', 'Last_name', 'Email', 'Phone_number', 'NIF'], 'required'],
            [['id', 'Phone_number', 'NIF', 'is_medico'], 'integer'],
            [['Birth_date'], 'safe'],
            [['gender'], 'string'],
            [['First_name', 'Last_name', 'postal_code'], 'string', 'max' => 20],
            [['Email'], 'string', 'max' => 25],
            [['Address'], 'string', 'max' => 255],
            [['NIF'], 'unique'],
            [['Email'], 'unique'],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'First_name' => 'First Name',
            'Last_name' => 'Last Name',
            'Email' => 'Email',
            'Phone_number' => 'Phone Number',
            'NIF' => 'Nif',
            'Address' => 'Address',
            'Birth_date' => 'Birth Date',
            'gender' => 'Gender',
            'postal_code' => 'Postal Code',
            'is_medico' => 'Is Medico',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
}
