<?php

use yii\db\Migration;
use backend\models\User;

/**
 * Class m200608_172002_create_rbac_data
 */
class m200608_172002_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Define permissions
        $adsPermission = $auth->createPermission('ads');
        $auth->add($adsPermission);
        $colorsPermission = $auth->createPermission('colors');
        $auth->add($colorsPermission);
        $moviesPermission = $auth->createPermission('movies');
        $auth->add($moviesPermission);
        $sessionsPermission = $auth->createPermission('sessions');
        $auth->add($sessionsPermission);
        $theatersPermission = $auth->createPermission('theaters');
        $auth->add($theatersPermission);

        $CRUDUsersListPermission = $auth->createPermission('CRUDUsersList');
        $auth->add($CRUDUsersListPermission);

        // Define roles with permissions
        $moderatorRole = $auth->createRole('moderator');
        $auth->add($moderatorRole);
        $auth->addChild($moderatorRole, $adsPermission);
        $auth->addChild($moderatorRole, $colorsPermission);
        $auth->addChild($moderatorRole, $moviesPermission);
        $auth->addChild($moderatorRole, $sessionsPermission);
        $auth->addChild($moderatorRole, $theatersPermission);

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);
        $auth->addChild($adminRole, $moderatorRole);
        $auth->addChild($adminRole, $CRUDUsersListPermission);

        // Create admin user
        $user = new User([
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password_hash' => '$2y$13$P9.d7KUb8C6BHCvkdzMsrOi5U.vIAw01UmriB.34PiN50e8nTGFge', // 111111
        ]);

        $user->generateAuthKey();
        $user->save();
        $auth->assign($adminRole, $user->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200608_172002_create_rbac_data cannot be reverted.\n";

        return false;
    }

}
