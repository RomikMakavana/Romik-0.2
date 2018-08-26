<?php

namespace backend\controller;

use backend\libs\Controller;
use backend\models\UserModel;
use config\DBConnection;
use backend\libs\RomikAdmin;

/**
 * user controller to login
 */
class UserController extends Controller {

    public function __construct() {
        $con = new DBConnection();
    }

    public function taskLogin() {
        $model = new UserModel();
        if ($model->checkUser()) {
            if ($model->checkLoggedIn())
                return TRUE;
            if (isset($_POST['login_button'])) {
                if ($model->login()) {
                    \backend\libs\RomikAdmin::goToAdmin();
                } else {
                    $error = 'In correct username or password.';
                    Controller::view('login', [
                        'error' => $error,
                            ], 'user');
                }
            } else {
                Controller::view('login', [], 'user');
            }
        } else {
            echo "<center><a class='btn btn-outline-secondary btn-lg gedeant' style='margin-top:40vh;' href='" . \libs\Url::toAdminUrl('user/migrate') . "'>Migrate</a></center>";
        }
    }

    public function taskLogout() {
        $model = new UserModel();
        if ($model->logout()) {
            \backend\libs\RomikAdmin::goToAdmin();
        }
    }

    public function taskMigrate() {
        $model = new UserModel();
        $model->migrate();
        $model->logout();
        RomikAdmin::goToAdmin();
    }

    public function taskChangePassword() {
        $model = new UserModel();
        if (isset($_POST['change_password'])) {
            if ($_POST['password'] == $_POST['conf-password']) {
                $model->changePass();
                $model->logout();
                \backend\libs\RomikAdmin::goToAdmin();
            } else {
                $error = 'Password doesn\'t matches.';
                Controller::view('changePassword', [
                    'error' => $error,
                        ], 'user');
            }
        } else {
            Controller::view('changePassword');
        }
    }

}
