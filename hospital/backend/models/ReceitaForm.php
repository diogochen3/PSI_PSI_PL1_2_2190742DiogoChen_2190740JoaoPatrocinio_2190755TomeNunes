<?php


namespace backend\models;


use common\models\Medicamento;
use common\models\ReceitaMedicamento;
use common\models\Receitas;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

class ReceitaForm extends Model
{
    public $id_receita;
    public $cod_acesso;
    public $cod_dispensa;
    public $quantidade;
    public $id_medicamento;
    public $posologia;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantidade','cod_acesso', 'cod_dispensa','id_medicamento','posologia'], 'required'],
            [['posologia'], 'string'],
            [['quantidade','cod_acesso', 'cod_dispensa','id_medicamento'], 'integer'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function enviar($id)
    {
        $datenow = Yii::$app->formatter->asDate('now', 'php:Y-m-d');
        if ($this->validate()) {
            $receita = new Receitas();
            $receita_medicamento = new ReceitaMedicamento();

            $receita->cod_acesso = $this->cod_acesso;
            $receita->cod_dispensa = $this->cod_dispensa;
            $receita->id_consulta = $id;
            $receita->data_emissao = $datenow;
            $receita->save();
            $receita_medicamento->id_receita = $receita->id;
            $receita_medicamento->id_medicamento = $this->id_medicamento;
            $receita_medicamento->quantidade = $this->quantidade;
            $receita_medicamento->posologia = $this->posologia;
            $receita_medicamento->save();
            $this->id_receita = $receita->id;

            return $receita && $receita_medicamento;
            /*$listquantidade = $_POST['ReceitaForm']['quantidade'];
            $receita_medicamento->quantidade = $item1;

            $listmedicamento = $_POST['ReceitaForm']['id_medicamento'];
            $receita_medicamento->id_medicamento = $item2;

            $listposologia = $_POST['ReceitaForm']['posologia'];
            $receita_medicamento->posologia= $item3;*/

            //$profile->save(false);*/
            /*$especialidadelist = $_POST['SignupForm']['id_especialidade'];
            foreach ($especialidadelist as $item) {
                $medico_Especialidade = new MedicoEspecialidade();
                $medico_Especialidade->id_especialidade = $item;
                $medico_Especialidade->id_medico = $profile->id;
                $medico_Especialidade->save();
            }

            // the following three lines were added:
            $auth = \Yii::$app->authManager;
            $utenteRole = $auth->getRole('medico');
            $auth->assign($utenteRole, $user->getId());

            return $user && $this->sendEmail($user) && $profile;*/
        }

        return null;
    }

    public function adicionar($id)
    {
        $receita_medicamento = new ReceitaMedicamento();
        $receita_medicamento->id_receita = $id;
        $receita_medicamento->id_medicamento = $this->id_medicamento;
        $receita_medicamento->quantidade = $this->quantidade;
        $receita_medicamento->posologia = $this->posologia;
        $receita_medicamento->save();
    }

}