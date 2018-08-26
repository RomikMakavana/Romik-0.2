<?php

namespace backend\models;

use config\DBConnection;
use backend\libs\RomikAdmin;

/**
 * model of user control
 */
class UserModel {

    public function __construct() {
        $this->DBcon = new DBConnection();
    }

    public function checkUser() {
        if ($this->DBcon->migrateAdmin())
            return TRUE;
        else
            return false;
    }

    public function migrate() {
        $qry = "CREATE TABLE IF NOT EXISTS `user` (
            `id` int(11) NOT NULL,
            `username` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `status` int(11) NOT NULL DEFAULT '1',
            `superadmin` smallint(6) DEFAULT '0',
            `created_at` int(11) NOT NULL,
            `updated_at` int(11) NOT NULL,
            `email` varchar(128) DEFAULT NULL,
            `email_confirmed` smallint(1) NOT NULL DEFAULT '0',
            `mobile` int(20) DEFAULT NULL
          );
              
        
        ALTER TABLE `user`
        ADD PRIMARY KEY (`id`);
        
        ALTER TABLE `user`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

        insert into user (`username`,`password`,`status`,`superadmin`,`created_at`,`updated_at`,`email`,`email_confirmed`,`mobile`) values ('superadmin', '1e0d5d98e358f0fb84716b91dea68b24' , 1 , 1 , " . time() . ", " . time() . ", '' , 0 , '' )
          ";
        $qry2 = "CREATE TABLE IF NOT EXISTS `user` (
            `id` int(11) NOT NULL,
            `username` varchar(255) NOT NULL,
            `auth_key` varchar(32) NOT NULL,
            `password_hash` varchar(255) NOT NULL,
            `confirmation_token` varchar(255) DEFAULT NULL,
            `status` int(11) NOT NULL DEFAULT '1',
            `superadmin` smallint(6) DEFAULT '0',
            `created_at` int(11) NOT NULL,
            `updated_at` int(11) NOT NULL,
            `registration_ip` varchar(15) DEFAULT NULL,
            `bind_to_ip` varchar(255) DEFAULT NULL,
            `email` varchar(128) DEFAULT NULL,
            `email_confirmed` smallint(1) NOT NULL DEFAULT '0',
            `mobile` int(20) DEFAULT NULL
          )";
        $insert = "INSERT INTO `user` (`username`, `password`, `status`, `superadmin`, `created_at`, `updated_at`, `email`, `email_confirmed`, `mobile`) VALUES ('superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 1, 1, " . date('now') . ", " . date('now') . ", NULL, NULL, NULL)";
        try {
            $tbl = $this->DBcon->con->exec($qry);
            return true;
        } catch (\PDOException $ex) {
            \libs\Error::message($ex->getMessage());
        }
    }

    public function checkLoggedIn() {
        if (session_status() != 2) {
            session_start();
        }
        if (!empty($_SESSION['adminUser']))
            return true;
        else
            return false;
    }

    public function login() {
        $db = new DBConnection();
        $data = $db->select('select * from user where username="' . $_POST['username'] . '" && password="' . md5(md5($_POST['password'])) . '" && superadmin = "1" && status= "1"');
        if (!empty($data[0]->id)) {
            $_SESSION['adminUser'] = $data[0]->id;
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        if (session_status() != 2) {
            session_start();
        }
        if (session_destroy())
            return true;
        else
            return false;
    }

    public function changePass() {
        $db = new DBConnection();
        if (!empty($_SESSION['adminUser'])) {
            $data = [
                'password' => md5(md5($_POST['password'])),
                'id' => $_SESSION['adminUser'],
                'superadmin' => "1",
                'status' => "1"
            ];
            $query = 'update user set password=:password where id=:id && superadmin =:superadmin && status=:status';
            $stmt = $db->con->prepare($query)->execute($data);
            return TRUE;
        } else {
            \backend\libs\RomikAdmin::goToAdmin();
        }
    }

}
