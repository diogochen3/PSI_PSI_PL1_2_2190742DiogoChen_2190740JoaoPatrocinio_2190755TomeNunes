<?php

namespace frontend\modules\api\models;

use frontend\mosquitto\phpMQTT;
use Yii;

/**
 * This is the model class for table "marcacao".
 *
 * @property int $id
 * @property string $date
 * @property string $tempo
 * @property int $Aceitar
 * @property int $id_especialidade
 * @property int $id_Utente
 * @property int $id_Medico
 *
 * @property Consultas $consultas
 * @property Especialidade $especialidade
 * @property User $medico
 * @property User $utente
 */
class Marcacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marcacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'tempo', 'Aceitar', 'id_especialidade', 'id_Utente', 'id_Medico'], 'required'],
            [['date', 'tempo'], 'safe'],
            [['Aceitar', 'id_especialidade', 'id_Utente', 'id_Medico'], 'integer'],
            [['id_especialidade'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::className(), 'targetAttribute' => ['id_especialidade' => 'id']],
            [['id_Medico'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_Medico' => 'id']],
            [['id_Utente'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_Utente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'tempo' => 'Tempo',
            'Aceitar' => 'Aceitar',
            'id_especialidade' => 'Id Especialidade',
            'id_Utente' => 'Id Utente',
            'id_Medico' => 'Id Medico',
        ];
    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //Obter dados do registo em causa
        $id=$this->id;
        $date=$this->date;
        $tempo=$this->tempo;
        $aceitar=$this->Aceitar;
        $idespecialidade=$this->id_especialidade;
        $idutente=$this->id_Utente;
        $idmedico=$this->id_Medico;
        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->date=$date;
        $myObj->preco=$tempo;
        $myObj->tempo=$aceitar;
        $myObj->id_especialidade=$idespecialidade;
        $myObj->id_Utente=$idutente;
        $myObj->id_Medico=$idmedico;
        $myJSON = json_encode($myObj);
        if($insert)
            $this->FazPublish("INSERT",$myJSON);
        else
            $this->FazPublish("UPDATE",$myJSON);

    }
    public function afterDelete()
    {
        parent::afterDelete();
        $prod_id= $this->id;
        $myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON = json_encode($myObj);
        $this->FazPublish("DELETE",$myJSON);
    }

    public function FazPublish($canal,$msg)
    {
        $server = "front.test";
        $port = 1883;
        $client_id = "phpMQTT-publisher"; // unique!
        $mqtt = new phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL))
        {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
        else { file_put_contents("debug.output","Time out!"); }
}

    /**
     * Gets query for [[Consultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasOne(Consultas::className(), ['id' => 'id']);
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
        return $this->hasOne(User::className(), ['id' => 'id_Medico']);
    }

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(User::className(), ['id' => 'id_Utente']);
    }
}
