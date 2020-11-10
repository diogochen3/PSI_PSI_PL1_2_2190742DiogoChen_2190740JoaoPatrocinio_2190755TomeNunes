<?php

use yii\db\Migration;

/**
 * Class m201026_155245_init_rba
 */
class m201026_155245_init_rba extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201026_155245_init_rba cannot be reverted.\n";
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "author" role and give this role the "createPost" permission
        $medico = $auth->createRole('Medico');
        $auth->add($medico);
        $auth->addChild($medico, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('administrador');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $medico);

        $user = $auth->createRole('utilizador');
        $auth->add($user);

        $func = $auth->add('funcionario');
        $auth->add($func);



        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($medico, 2);
        $auth->assign($admin, 1);
        $auth->assign($user, 3);
    }

    public function down()
    {
        echo "m201026_155245_init_rba cannot be reverted.\n";

        $auth = Yii::$app->authManager;

        $auth->removeAll();
        return false;
    }

}
