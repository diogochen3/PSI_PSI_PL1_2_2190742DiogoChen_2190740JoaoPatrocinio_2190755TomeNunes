<?php

namespace common\models;
use yii\db\ActiveRecord;
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
        ];
    }
    public static function findByNif($nif)
    {
        return static::findOne(['nif' => $nif, 'status' => self::STATUS_ACTIVE]);
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
