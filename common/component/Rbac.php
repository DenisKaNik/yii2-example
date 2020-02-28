<?php

namespace common\component;

use Yii;
use yii\rbac\DbManager;

class Rbac extends DbManager
{
	public function isAuth($roles = false)
    {
        if (!empty($roles)) {
            if (!is_array($roles)) {
                $role = $roles;
                unset($roles);
                $roles[] = $role;
            }

            foreach ($roles as $role) {
                if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getID())[$role]->name) &&
                    Yii::$app->authManager->getRolesByUser(Yii::$app->user->getID())[$role]->name == $role) {
                    return true;
                }
            }
        }

        return false;
    }

}
