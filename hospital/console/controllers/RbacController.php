<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
        // add "createPost" permission
        $createMarc = $auth->createPermission('createMarcacao');
        $createMarc->description = 'Criar marcação';
        $auth->add($createMarc);

        // add "updatePost" permission
        $updateMarc = $auth->createPermission('updateMarcacao');
        $updateMarc->description = 'Alterar marcação';
        $auth->add($updateMarc);

        $deleteMarc = $auth->createPermission('DeleteMarcacao');
        $deleteMarc->description = 'Eliminar marcação';
        $auth->add($deleteMarc);

        $sendReceita = $auth->createPermission('SendReceita');
        $sendReceita->description = 'enviar receita';
        $auth->add($sendReceita);

        $createReceita = $auth->createPermission('CreateReceita');
        $createReceita->description = 'Criar receita';
        $auth->add($createReceita);

        $createMedico = $auth->createPermission('CreateMedico');
        $createMedico->description = 'Criar Medico';
        $auth->add($createMedico);

        $deleteMedico = $auth->createPermission('DeleteMedico');
        $deleteMedico->description = 'Eliminar Medico';
        $auth->add($deleteMedico);

        $updateMedico = $auth->createPermission('UpdateMedico');
        $updateMedico->description = 'Alterar Medico';
        $auth->add($updateMedico);

        // add "author" role and give this role the "createPost" permission
        $utente = $auth->createRole('utente');
        $auth->add($utente);
        $auth->addChild($utente, $createMarc);
        $auth->addChild($utente, $updateMarc);
        $auth->addChild($utente, $deleteMarc);


        $medico = $auth->createRole('medico');
        $auth->add($medico);
        $auth->addChild($medico, $updateMarc);
        $auth->addChild($medico, $deleteMarc);
        $auth->addChild($medico, $sendReceita);
        $auth->addChild($medico, $createReceita);
        $auth->addChild($medico, $updateMedico);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createMedico);
        $auth->addChild($admin, $deleteMedico);
        $auth->addChild($admin, $medico);

        $func = $auth->createRole('funcionario');
        $auth->add($func);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($utente, 4);
        $auth->assign($func, 3);
        $auth->assign($medico, 2);
        $auth->assign($admin, 1);
    }

}