<?php

namespace app\models;

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
 * @property string $Address
 * @property string $Birth_date
 * @property string $gender
 * @property string $postal_code
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
            [['id', 'First_name', 'Last_name', 'Email', 'Phone_number', 'NIF', 'Address', 'Birth_date', 'gender', 'postal_code'], 'required'],
            [['id', 'Phone_number', 'NIF'], 'integer'],
            [['Birth_date'], 'safe'],
            [['gender'], 'string'],
            [['First_name', 'Last_name', 'postal_code'], 'string', 'max' => 20],
            [['Email'], 'string', 'max' => 25],
            [['Address'], 'string', 'max' => 255],
            [['NIF'], 'unique'],
            [['Email'], 'unique'],
            [['id'], 'unique'],
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
        ];
    }
}
